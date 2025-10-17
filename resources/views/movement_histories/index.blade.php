<div class="container">
<h2>movement_histories List</h2>
<a href="{{ route('movement_histories.create') }}" class="btn btn-primary mb-3">Create movement_histories</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($movement_histories as $item)
                <tr>
                    <td>
                        <a href="{{ route('movement_histories.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('movement_histories.destroy', $item->id) }}" method="POST" style="display:inline;">
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