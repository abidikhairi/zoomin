@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header">
                        {{ __('names.claims.response.name') }}
                    </div>
                    <div class="card-body">
                        <div class='embed-responsive' style='padding-bottom:150%'>
                            <object data='{{ \Illuminate\Support\Str::replace('public', 'storage', $response->report_file) }}' type='application/pdf' width='100%' height='80%'></object>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
