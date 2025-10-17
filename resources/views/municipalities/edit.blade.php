<div class="container">
    <h2>Edit municipality</h2>
    <form action="{{ route('municipalities.update', $municipality->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>