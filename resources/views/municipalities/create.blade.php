<div class="container">
    <h2>Create municipalities</h2>
    <form action="{{ route('municipalities.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>