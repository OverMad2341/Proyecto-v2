<div class="container">
    <h2>Edit category</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>