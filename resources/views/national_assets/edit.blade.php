<div class="container">
    <h2>Edit nationalAsset</h2>
    <form action="{{ route('national_assets.update', $nationalAsset->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>