@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('sidebar.magistrate.list_claim') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('fields.governorate.name') }}</th>
                                    <th>{{ trans_choice('names.citizen.name', 1) }}</th>
                                    <th>{{ __('fields.sector.name') }}</th>
                                    <th>{{ __('fields.establishment.name') }}</th>
                                    <th>{{ __('tables.actions') }}</th>
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
                                                <a href="{{ route('report.claim.respond.form', ['claim' => $claim->id]) }}" class="btn btn-sm btn-info">{{ __('tables.answer') }}</a>
                                            @endif
                                            <a href="{{ route('report.claim.show', ['claim'=> $claim->id]) }}" class="btn btn-sm btn-danger">{{ __('tables.files') }}</a>
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
