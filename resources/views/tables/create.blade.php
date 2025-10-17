<div class="container">
    <h2>Create tables</h2>
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>