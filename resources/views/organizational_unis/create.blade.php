<div class="container">
    <h2>Create organizational_unis</h2>
    <form action="{{ route('organizational_unis.store') }}" method="POST">
        @csrf
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>