<div class="container">
    <h2>Create teams</h2>
    <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>