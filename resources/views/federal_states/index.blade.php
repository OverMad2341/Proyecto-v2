<div class="container">
<h2>federal_states List</h2>
<a href="{{ route('federal_states.create') }}" class="btn btn-primary mb-3">Create federal_states</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($federal_states as $item)
                <tr>
                    <td>
                        <a href="{{ route('federal_states.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('federal_states.destroy', $item->id) }}" method="POST" style="display:inline;">
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