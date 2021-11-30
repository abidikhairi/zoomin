@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('sidebar.magistrate.list_report') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('forms.report.title') }}</th>
                                <th>{{ __('fields.sector.name') }}</th>
                                <th>{{ __('fields.establishment.name') }}</th>
                                <th>{{ __('fields.governorate.name') }}</th>
                                <th>{{ ('نوع التقرير') }}</th>
                                <th>{{ __('tables.actions') }}</th>
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
                                        @if(auth()->user()->role == \App\AppRoles::ROLE_MAGISTRATE)
                                            <a href="{{ route('report.comment.show', ['report' => $report->id]) }}" class="btn btn-sm btn-primary">{{ __('tables.comment') }}</a>
                                        @elseif(auth()->user()->role == \App\AppRoles::ROLE_ROOM_PRESIDENT)
                                            <a href="{{ route('room-president.report.comment.index', ['report' => $report->id]) }}" class="btn btn-sm btn-primary">{{ __('tables.comment') }}</a>
                                        @endif
                                        @if(auth()->user()->role == \App\AppRoles::ROLE_ROOM_PRESIDENT && $report->visible == false)
                                            <a href="{{ route('room-president.report.publish', ['report' => $report->id]) }}" class="btn btn-sm btn-info">{{ 'نشر' }}</a>
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
