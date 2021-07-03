@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Claims List') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('governorate') }}</th>
                                    <th>{{ __('citizen') }}</th>
                                    <th>{{ __('sector') }}</th>
                                    <th>{{ __('establishment') }}</th>
                                    <th>{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($claims as $claim)
                                    <tr>
                                        <td>{{ $claim->establishment->governorate->name }}</td>
                                        <td>{{ $claim->citizen->user->email }}</td>
                                        <td>{{ $claim->sector->name }}</td>
                                        <td>{{ $claim->establishment->name }}</td>
                                        <td>
                                            @if(!$claim->response)
                                                <a href="{{ route('report.claim.respond.form', ['claim' => $claim->id]) }}" class="btn btn-sm btn-info">{{ __('respond') }}</a>
                                            @endif
                                            <a href="{{ route('report.claim.show', ['claim'=> $claim->id]) }}" class="btn btn-sm btn-danger">{{ __('files') }}</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
