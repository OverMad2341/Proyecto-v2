<div class="container">
<h2>national_asset_assignaments List</h2>
<a href="{{ route('national_asset_assignaments.create') }}" class="btn btn-primary mb-3">Create national_asset_assignaments</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($national_asset_assignaments as $item)
                <tr>
                    <td>
                        <a href="{{ route('national_asset_assignaments.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('national_asset_assignaments.destroy', $item->id) }}" method="POST" style="display:inline;">
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