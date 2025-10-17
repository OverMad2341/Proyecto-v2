<div class="container">
<h2>teams List</h2>
<a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Create teams</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($teams as $item)
                <tr>
                    <td>
                        <a href="{{ route('teams.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teams.destroy', $item->id) }}" method="POST" style="display:inline;">
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