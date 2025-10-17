<div class="container">
    <h2>Create movement_histories</h2>
    <form action="{{ route('movement_histories.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>