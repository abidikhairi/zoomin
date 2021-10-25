@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Reports List') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('title') }}</th>
                                <th>{{ __('sector') }}</th>
                                <th>{{ __('establishment') }}</th>
                                <th>{{ __('governorate') }}</th>
                                <th>{{ __('type') }}</th>
                                <th>{{ __('actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->title }}</td>
                                    <td>{{ $report->sector->name }}</td>
                                    <td>{{ $report->establishment->name }}</td>
                                    <td>{{ $report->establishment->governorate->name }}</td>
                                    <td>{{ $report->type }}</td>
                                    <td>
                                        <a href="{{ route('room-president.report.comment.index', ['report' => $report->id]) }}" class="btn btn-sm btn-primary">comment</a>
                                        @if(auth()->user()->role == \App\AppRoles::ROLE_ROOM_PRESIDENT && $report->visible == false)
                                            <a href="{{ route('room-president.report.publish', ['report' => $report->id]) }}" class="btn btn-sm btn-info">publish</a>
                                        @endif
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
