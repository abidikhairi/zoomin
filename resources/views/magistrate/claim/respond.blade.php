@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{ route('report.claim.respond') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="claim" value="{{ $claim->id }}">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-black-50 mb-1">{{ __('respond') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <label for="report_file">{{ __('report') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="report_file" name="report_file">
                                    <label class="custom-file-label" for="report_file">{{ __('choose_file') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">{{ __('submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
