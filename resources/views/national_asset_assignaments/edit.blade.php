<div class="container">
    <h2>Edit nationalAssetAssignament</h2>
    <form action="{{ route('national_asset_assignaments.update', $nationalAssetAssignament->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>