<div class="container">
    <h2>Create employees</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>