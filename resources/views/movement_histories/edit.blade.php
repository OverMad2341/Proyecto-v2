<div class="container">
    <h2>Edit movementHistory</h2>
    <form action="{{ route('movement_histories.update', $movementHistory->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>