<div class="container">
    <h2>Edit federalState</h2>
    <form action="{{ route('federal_states.update', $federalState->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>