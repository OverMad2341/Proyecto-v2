<div class="container">
    <h2>Edit subCategory</h2>
    <form action="{{ route('sub_categories.update', $subCategory->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>