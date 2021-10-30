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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->title }}</td>
                                        @if($report->reportType->has_sector)
                                            <td>{{ $report->sector->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($report->reportType->has_establishment)
                                            <td>{{ $report->establishment->name }}</td>
                                            <td>{{ $report->establishment->governorate->name }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        <td>{{ $report->reportType->type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {!! $reports->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
