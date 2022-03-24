@if (Session::has('message'))
<div class="alert alert-success">
<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
  <strong>Success!</strong> {!! session('message') !!}
</div>
@endif