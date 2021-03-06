@extends('layouts.app')

@section('body')
    <body class="light rtl">
    <div class="wrapper">
        <div class="row align-items-center">
            <form class="col-lg-6 col-md-8 col-10 mx-auto" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mx-auto text-center my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/') }}">
                        <svg id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
                    </a>
                    <h2 class="my-3">{{ __('forms.register') }}</h2>
                </div>
                <div class="form-group">
                    <label for="email">{{ __('forms.fields.email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">{{ __('forms.fields.first_name') }}</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        @error('first_name')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">{{ __('forms.fields.last_name') }}</label>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telephone">{{__('forms.fields.telephone')}}</label>
                        <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                        @error('telephone')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="profil">{{ __('forms.fields.profil') }}</label>
                        <select id="profil" type="text" class="form-control @error('profil') is-invalid @enderror" name="profil" required>
                            @foreach(\App\Models\Citizen\Profile::all() as $profile)
                                <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                            @endforeach
                        </select>
                        @error('profil')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
                <hr class="my-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">{{ __('forms.fields.password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('forms.fields.confirm_password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('forms.register') }}</button>
                <p class="mt-5 mb-3 text-muted text-center">?? 2020</p>
            </form>
        </div>
    </div>
    </body>
@endsection
