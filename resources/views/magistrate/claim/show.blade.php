@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="page-title">{{ __('files') }}</h2>
                    </div>
                </div>
                <div class="card-deck mb-4">
                    @foreach($claim->files as $index => $path)
                        <div class="card border-0 bg-transparent">
                            <img src="{{ \Illuminate\Support\Str::replace('public', 'storage', $path) }}" alt="..." class="card-img-top img-fluid rounded">
                            <div class="card-body">
                                <p class="text-black-50 mb-1">
                                    {{ $claim->subject }}
                                </p>
                            </div>
                        </div> <!-- .card -->
                    @endforeach
                </div> <!-- .card-deck -->
            </div>
        </div>
    </div>
@endsection
