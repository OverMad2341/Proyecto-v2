<div class="container">
    <h2>Create people</h2>
    <form action="{{ route('people.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>