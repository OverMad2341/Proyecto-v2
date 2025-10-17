<div class="container">
<h2>municipalities List</h2>
<a href="{{ route('municipalities.create') }}" class="btn btn-primary mb-3">Create municipalities</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($municipalities as $item)
                <tr>
                    <td>
                        <a href="{{ route('municipalities.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('municipalities.destroy', $item->id) }}" method="POST" style="display:inline;">
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