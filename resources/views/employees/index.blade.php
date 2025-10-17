<div class="container">
<h2>employees List</h2>
<a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create employees</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($employees as $item)
                <tr>
                    <td>
                        <a href="{{ route('employees.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('employees.destroy', $item->id) }}" method="POST" style="display:inline;">
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