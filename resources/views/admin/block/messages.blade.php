@foreach($errors->all() as $error)
    @php(toastr()->error(__($error)))
@endforeach

@if(Session::has('success'))
    @php(toastr()->success(__(Session::get('success'))))
@endif
