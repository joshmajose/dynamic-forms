@if ($errors->any())
<div class="alert alert-danger" role="alert">
<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>

    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif