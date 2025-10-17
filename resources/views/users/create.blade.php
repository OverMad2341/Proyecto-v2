<div class="container">
    <h2>Create users</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cedula" class="form-label">cedula</label>
            <input type="text" class="form-control" name="cedula" value="{{old("cedula")}}">
            @error("cedula")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" name="name" value="{{old("name")}}">
            @error("name")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="name_02" class="form-label">name_02</label>
            <input type="text" class="form-control" name="name_02" value="{{old("name_02")}}">
            @error("name_02")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="surname_01" class="form-label">surname_01</label>
            <input type="text" class="form-control" name="surname_01" value="{{old("surname_01")}}">
            @error("surname_01")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="surname_02" class="form-label">surname_02</label>
            <input type="text" class="form-control" name="surname_02" value="{{old("surname_02")}}">
            @error("surname_02")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="birth_date" class="form-label">birth_date</label>
            <input type="text" class="form-control" name="birth_date" value="{{old("birth_date")}}">
            @error("birth_date")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="birth_place" class="form-label">birth_place</label>
            <input type="text" class="form-control" name="birth_place" value="{{old("birth_place")}}">
            @error("birth_place")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="sex" class="form-label">sex</label>
            <input type="text" class="form-control" name="sex" value="{{old("sex")}}">
            @error("sex")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="nationality" class="form-label">nationality</label>
            <input type="text" class="form-control" name="nationality" value="{{old("nationality")}}">
            @error("nationality")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="text" class="form-control" name="email" value="{{old("email")}}">
            @error("email")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="email_verified_at" class="form-label">email_verified_at</label>
            <input type="text" class="form-control" name="email_verified_at" value="{{old("email_verified_at")}}">
            @error("email_verified_at")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input type="text" class="form-control" name="password" value="{{old("password")}}">
            @error("password")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="remember_token" class="form-label">remember_token</label>
            <input type="text" class="form-control" name="remember_token" value="{{old("remember_token")}}">
            @error("remember_token")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="birth_country" class="form-label">birth_country</label>
            <input type="text" class="form-control" name="birth_country" value="{{old("birth_country")}}">
            @error("birth_country")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="current_team_id" class="form-label">current_team_id</label>
            <input type="text" class="form-control" name="current_team_id" value="{{old("current_team_id")}}">
            @error("current_team_id")
                <p>{{$message}}</p>
            @enderror
        </div>
<div class="mb-3">
            <label for="profile_photo_path" class="form-label">profile_photo_path</label>
            <input type="text" class="form-control" name="profile_photo_path" value="{{old("profile_photo_path")}}">
            @error("profile_photo_path")
                <p>{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>