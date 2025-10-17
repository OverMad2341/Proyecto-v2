<div class="container">
    <h2>Edit table</h2>
    <form action="{{ route('tables.update', $table->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>