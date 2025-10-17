<div class="container">
    <h2>Create sub_categories</h2>
    <form action="{{ route('sub_categories.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>