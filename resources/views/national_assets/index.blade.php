<div class="container">
<h2>national_assets List</h2>
<a href="{{ route('national_assets.create') }}" class="btn btn-primary mb-3">Create national_assets</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($national_assets as $item)
                <tr>
                    <td>
                        <a href="{{ route('national_assets.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('national_assets.destroy', $item->id) }}" method="POST" style="display:inline;">
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