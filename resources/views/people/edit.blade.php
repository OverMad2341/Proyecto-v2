<div class="container">
    <h2>Edit person</h2>
    <form action="{{ route('people.update', $person->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>