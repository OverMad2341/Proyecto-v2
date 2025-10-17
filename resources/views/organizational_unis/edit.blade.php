<div class="container">
    <h2>Edit organizationalUni</h2>
    <form action="{{ route('organizational_unis.update', $organizationalUni->id) }}" method="POST">
        @csrf
        @method("PATCH")
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>