@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center  ">
            <div class="col-md-10">
                <form id="report-form" action="{{ route('report.store.step1') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">{{ __('Add Report') }}</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title">{{ __('title') }}</label>
                                        <input type="text" id="title" name="title" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="year">{{ __('year') }}</label>
                                        <input type="number" id="year" name="year" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="link">{{ __('link') }}</label>
                                        <input type="text" name="link" id="link" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="type">{{ __('type') }}</label>
                                        <select name="type" id="type" class="form-control select2">
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="sector">{{ __('Sector') }}</label>
                                        <select name="sector" id="sector" class="form-control select2">
                                            @foreach($sectors as $sector)
                                                <option value="{{ $sector->id }}"> {{ $sector->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="establishment">{{ __('Establishment') }}</label>
                                        <select name="establishment" id="establishment" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="observations">{{ __('observations') }}</label>
                                        <input type="number" name="observations" id="observations" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pdf_file">{{ __('Report File') }}</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="pdf_file" id="pdf_file">
                                            <label class="custom-file-label" for="pdf_file">{{ __('choose_file') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" type="submit">
                                {{ __('submit') }}
                            </button>
                            <button type="reset" class="btn btn-danger">
                                {{ __('reset') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
