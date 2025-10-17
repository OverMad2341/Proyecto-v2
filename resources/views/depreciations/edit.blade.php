<div class="container">
    <h2>Edit depreciation</h2>
    <form action="{{ route('depreciations.update', $depreciation->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>