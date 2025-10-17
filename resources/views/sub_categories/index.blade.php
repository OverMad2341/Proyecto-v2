<div class="container">
<h2>sub_categories List</h2>
<a href="{{ route('sub_categories.create') }}" class="btn btn-primary mb-3">Create sub_categories</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($sub_categories as $item)
                <tr>
                    <td>
                        <a href="{{ route('sub_categories.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('sub_categories.destroy', $item->id) }}" method="POST" style="display:inline;">
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