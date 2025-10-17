<div class="container">
    <h2>Create parishes</h2>
    <form action="{{ route('parishes.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>