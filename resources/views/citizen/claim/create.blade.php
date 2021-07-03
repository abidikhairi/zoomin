@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">{{ __('Send Claim') }}</strong>
                    </div>
                    <div class="card-body">
                        <form id="claim-form" class="needs-validation was-validated" action="{{ route('claim.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">{{ __('first name') }}</label>
                                    <input type="text" class="form-control" id="first_name" value="{{ auth()->user()->first_name }}" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">{{ __('last name') }}</label>
                                    <input type="text" class="form-control" id="last_name" value="{{ auth()->user()->last_name }}" disabled>
                                </div>
                            </div> <!-- /.form-row -->
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ auth()->user()->email }}" disabled>
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                            </div> <!-- /.form-row -->
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="sector">{{ __('Sector') }}</label>
                                    <select name="sector" id="sector" class="form-control">
                                        @foreach($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3" id="establishment-field">
                                    <label for="establishment">{{ __('Establishment') }}</label>
                                    <select name="establishment" id="establishment" class="form-control">

                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="claim_type">{{ __('claim.type') }}</label>
                                    <select name="claim_type" id="claim_type" class="form-control">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label for="subject">{{ __('Subject') }}</label>
                                    <textarea name="subject" id="subject" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="files">Custom file input</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="files" name="files[]" multiple>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
                        </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
