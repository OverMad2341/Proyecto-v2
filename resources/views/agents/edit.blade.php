<div class="container">
    <h2>Edit agent</h2>
    <form action="{{ route('agents.update', $agent->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>