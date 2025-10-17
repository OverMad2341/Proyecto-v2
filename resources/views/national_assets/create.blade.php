<div class="container">
    <h2>Create national_assets</h2>
    <form action="{{ route('national_assets.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>