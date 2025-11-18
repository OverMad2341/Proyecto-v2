<?php

namespace App\Http\Controllers;

use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Mail\SendVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    /**
     * Genera un nuevo código, lo guarda y lo envía por correo.
     */
    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        // Genera un código de 6 dígitos
        $code = strval(rand(100000, 999999));

        // Guarda o actualiza el código en la BD
        // updateOrCreate buscará por 'email' y actualizará o creará
        EmailVerificationCode::updateOrCreate(
            ['email' => $email],
            ['code' => $code, 'created_at' => now()]
        );

        // Envía el correo
        Mail::to($email)->send(new SendVerificationCode($code));

        // Para Inertia, es bueno no devolver nada o una respuesta simple
        return redirect()->back()->with('success', 'Código reenviado');
    }

    /**
     * Verifica el código ingresado por el usuario.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|min:6|max:6',
        ]);

        $record = EmailVerificationCode::where('email', $request->email)->first();

        // 1. ¿No existe el registro?
        if (!$record) {
            return redirect()->back()->withErrors(['code' => 'Código inválido o expirado.']);
        }

        // 2. ¿Ha expirado? (Ej. 15 minutos)
        $expiryTime = Carbon::parse($record->created_at)->addMinutes(15);
        if (Carbon::now()->isAfter($expiryTime)) {
            $record->delete(); // Limpia el código expirado
            return redirect()->back()->withErrors(['code' => 'Tu código ha expirado. Por favor, solicita uno nuevo.']);
        }

        // 3. ¿El código no coincide?
        if ($record->code !== $request->code) {
            return redirect()->back()->withErrors(['code' => 'El código de verificación es incorrecto.']);
        }

        // --- ¡Éxito! ---
        
        // 1. Marca al usuario como verificado
        // (Asumiendo que el usuario ya se creó en el paso de registro)
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
        }

        // 2. Limpia el código de la BD
        $record->delete();

        // 3. Redirige al dashboard (o donde quieras)
        return redirect()->route('dashboard'); // Asegúrate de tener una ruta 'dashboard'
    }
}