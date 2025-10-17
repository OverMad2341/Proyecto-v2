<div class="container">
<h2>organizational_unis List</h2>
<a href="{{ route('organizational_unis.create') }}" class="btn btn-primary mb-3">Create organizational_unis</a>
<table class="table">
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        @foreach ($organizational_unis as $item)
                <tr>
                    <td>
                        <a href="{{ route('organizational_unis.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('organizational_unis.destroy', $item->id) }}" method="POST" style="display:inline;">
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