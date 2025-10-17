<div class="container">
    <h2>Create depreciations</h2>
    <form action="{{ route('depreciations.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>