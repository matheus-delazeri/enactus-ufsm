<div class="my-3 position-fixed d-flex flex-column align-items-end w-100">
    @foreach($errors->all() as $error)
        <span class="alert alert-danger w-25 mx-5 mb-1">{{ $error }}</span>
    @endforeach

    @if(Session::has('success'))
        <span class="alert alert-success w-25 mx-5">{{ Session::get('success')  }}</span>
    @endif
</div>

<script type="module">
    $('.alert').delay(2000).fadeOut()
</script>
