<div class="container">
    <h2>Create agents</h2>
    <form action="{{ route('agents.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>