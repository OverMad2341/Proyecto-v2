<div class="container">
    <h2>Create locations</h2>
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>