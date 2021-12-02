@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ ('الشكاوي المقبولة') }}</h5>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{ trans_choice('names.administration.magistrate', 1) }}</th>
                                <th>{{ trans_choice('names.administration.sector', 1) }}</th>
                                <th>{{ trans_choice('names.administration.establishment', 1) }}</th>
                                <th>{{ trans_choice('names.administration.governorate', 1) }}</th>
                                <th>{{ ('أجراءات') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($respondedClaims as $claim)
                                <tr>
                                    <td>
                                        {{ $claim->magistrate->user->full_name }}
                                    </td>
                                    <td>
                                        {{ $claim->sector->name }}
                                    </td>
                                    <td>
                                        {{ $claim->establishment->name }}
                                    </td>
                                    <td>
                                        {{ $claim->establishment->governorate->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('room-president.claim.response.show', ['response' => $claim->response->id]) }}" class="btn btn-sm btn-primary">
                                            {{ ('الاضطلاع') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ ('الشكاوي') }}</h5>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{ trans_choice('names.citizen.name', 1) }}</th>
                                <th>{{ trans_choice('names.administration.sector', 1) }}</th>
                                <th>{{ trans_choice('names.administration.establishment', 1) }}</th>
                                <th>{{ trans_choice('names.administration.governorate', 1) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($waitingList as $claim)
                                <tr>
                                    <td>
                                        {{ $claim->citizen->user->email }}
                                    </td>
                                    <td>
                                        {{ $claim->sector->name }}
                                    </td>
                                    <td>
                                        {{ $claim->establishment->name }}
                                    </td>
                                    <td>
                                        {{ $claim->establishment->governorate->name }}
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
