<div class="container">
    <h2>Edit team</h2>
    <form action="{{ route('teams.update', $team->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>