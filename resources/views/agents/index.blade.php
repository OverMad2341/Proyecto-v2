<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Agentes</h2>
        <a href="{{ route('agents.create') }}" class="btn btn-primary">Crear agente</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($agents->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Compañía</th>
                        <th scope="col">Creado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agents as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>{{ $item->email ?? '-' }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                            <td>{{ $item->company ?? '-' }}</td>
                            <td>{{ optional($item->created_at)->format('Y-m-d') ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('agents.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>

                                <form action="{{ route('agents.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar agente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $agents->links() }}
        </div>
    @else
        <div class="alert alert-info">No hay agentes registrados.</div>
    @endif
</div>