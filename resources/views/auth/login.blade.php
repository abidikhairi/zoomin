@extends('layouts.app')

@section('body')
    <body class="light rtl">
        <div class="row align-items-center mt-5 pt-5">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST" action="{{ route('login') }}">
            @csrf
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/') }}">
                <svg id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg>
            </a>
            <h1 class="h6 mb-3">{{ __('forms.login') }}</h1>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">{{ __('forms.fields.email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">{{ __('forms.fields.password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me" name="remember">
                    {{ __('forms.remebmer_me') }}
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('forms.enter') }}</button>
        </form>
    </div>
    </body>
@endsection
