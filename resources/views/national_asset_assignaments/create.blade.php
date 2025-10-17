<div class="container">
    <h2>Create national_asset_assignaments</h2>
    <form action="{{ route('national_asset_assignaments.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>