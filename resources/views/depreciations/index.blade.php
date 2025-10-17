<div class="container">
<h2>depreciations List</h2>
<a href="{{ route('depreciations.create') }}" class="btn btn-primary mb-3">Create depreciations</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($depreciations as $item)
                <tr>
                    <td>
                        <a href="{{ route('depreciations.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('depreciations.destroy', $item->id) }}" method="POST" style="display:inline;">
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