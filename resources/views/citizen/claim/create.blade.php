@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">{{ ('استمارة: شكوى') }}</strong>
                    </div>
                    <div class="card-body">
                        <form id="claim-form" class="needs-validation was-validated" action="{{ route('claim.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">{{ __('forms.fields.first_name') }}</label>
                                    <input type="text" class="form-control" id="first_name" value="{{ auth()->user()->first_name }}" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">{{ __('forms.fields.last_name') }}</label>
                                    <input type="text" class="form-control" id="last_name" value="{{ auth()->user()->last_name }}" disabled>
                                </div>
                            </div> <!-- /.form-row -->
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="email">{{ __('forms.fields.email') }}</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ auth()->user()->email }}" disabled>
                                    <small id="emailHelp" class="form-text text-muted">لن نشارك بريدك الإلكتروني مع أي شخص آخر.</small>
                                </div>
                            </div> <!-- /.form-row -->
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="governorate">{{ __('fields.governorate.name') }}</label>
                                    <select name="governorate" id="governorate" class="form-control">
                                        <option value="" selected>{{'الاختيار ...'}}</option>
                                        @foreach($governorates as $governorate)
                                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="sector">{{ __('fields.sector.name') }}</label>
                                    <select name="sector" id="sector" class="form-control">
                                        <option value="" selected>{{ 'الاختيار ...' }}</option>
                                        @foreach($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3" id="establishment-field">
                                    <label for="establishment">{{ __('fields.establishment.name') }}</label>
                                    <select name="establishment" id="establishment" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label for="subject">{{ __('forms.fields.subject') }}</label>
                                    <textarea name="subject" id="subject" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="files">{{ __('forms.fields.files') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="files" name="files[]" multiple>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">{{ __('forms.fields.accept') }}</button>
                        </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
