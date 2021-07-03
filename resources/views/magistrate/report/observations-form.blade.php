@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-accent-primary" id="observations-forms">
                    <div class="card-header">
                        <strong>{{__('Observations')}}: {{ $report->title }}</strong>
                    </div>
                    <div class="card-body">
                        @for($i = 0; $i < $observations; $i++)
                            <div class="row">
                                <div class="col-md-12">
                                    @include('magistrate.report.observation-form',['formId' => "observation-$i"])
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn mce-btn-flat btn-primary" id="send-observations">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
