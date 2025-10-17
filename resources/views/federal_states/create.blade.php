<div class="container">
    <h2>Create federal_states</h2>
    <form action="{{ route('federal_states.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>