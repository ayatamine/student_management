@if (session()->has('message'))
    <div class="alert alert-success  alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session()->get('message') }}</div>
@endif

@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger  alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $error }}</div>
    @endforeach
@endif