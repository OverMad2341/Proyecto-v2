<div class="container">
    <h2>Create categories</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>