<div class="container">
    <h2>Edit parish</h2>
    <form action="{{ route('parishes.update', $parish->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>