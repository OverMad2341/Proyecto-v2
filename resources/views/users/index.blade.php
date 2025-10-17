<div class="container">
<h2>users List</h2>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create users</a>
<table class="table">
    <thead>
        <tr><th>cedula</th><th>name</th><th>name_02</th><th>surname_01</th><th>surname_02</th><th>birth_date</th><th>birth_place</th><th>sex</th><th>nationality</th><th>email</th><th>email_verified_at</th><th>password</th><th>remember_token</th><th>birth_country</th><th>current_team_id</th><th>profile_photo_path</th></tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
                <tr>
                    <td>{{$item->cedula}}</td>
<td>{{$item->name}}</td>
<td>{{$item->name_02}}</td>
<td>{{$item->surname_01}}</td>
<td>{{$item->surname_02}}</td>
<td>{{$item->birth_date}}</td>
<td>{{$item->birth_place}}</td>
<td>{{$item->sex}}</td>
<td>{{$item->nationality}}</td>
<td>{{$item->email}}</td>
<td>{{$item->email_verified_at}}</td>
<td>{{$item->password}}</td>
<td>{{$item->remember_token}}</td>
<td>{{$item->birth_country}}</td>
<td>{{$item->current_team_id}}</td>
<td>{{$item->profile_photo_path}}</td>
<td>
                        <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>