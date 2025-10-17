<div class="container">
    <h2>Edit location</h2>
    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>