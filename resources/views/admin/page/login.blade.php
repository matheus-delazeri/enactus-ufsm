@extends('admin.layout.default', ['menu' => false, 'footer' => false])

@section('content')
    <div class="container-fluid h-50 align-items-center">
        <div class="row no-gutter justify-content-center">
            <div class="col-md-8 col-lg-8">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 mx-auto">
                                <h2 class="login-heading mb-5"><i class="fa fa-newspaper"></i>{{ config('app.name') }}</h2>
                                <form action="{{ route('admin.login')  }}" method="POST" id="logForm">
                                    {{ csrf_field() }}
                                    <div class="form-label-group">
                                        <label for="inputUser">{{ __("E-mail") }}</label>
                                        <input type="email" name="email" class="form-control" placeholder="{{__("E-mail")}}" >
                                    </div>
                                    <br>
                                    <div class="form-label-group">
                                        <label for="inputPassword">{{ __("Password") }}</label>
                                        <input type="password" name="password" class="form-control" placeholder="{{__("Password")}}" >
                                    </div>
                                    <br>
                                    <button class="btn btn-mb btn-primary text-uppercase mb-2" type="submit">{{ __("Sign in") }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
