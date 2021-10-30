@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('Report: '). $report->title }}</strong>
                    </div>
                    <div class="card-body">
                        <h5 class="text-black-50"><strong>Observations</strong></h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('observation') }}</th>
                                <th>{{ __('financial impact') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($report->observations as $observation)
                                <tr>
                                    <td>{{ $observation->observation }}</td>
                                    <td>{{ $observation->financial_impact }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-fill timeline">
                    <div class="card-header">
                        <strong class="card-title">Comments</strong>
                    </div>
                    <div class="card-body">
                        @foreach($comments as $comment)
                            <div class="pb-3 timeline-item item-success">
                                <div class="pl-5">
                                    <div class="mb-3">
                                        <strong>{{ $comment->magistrate->user->name }}</strong>
                                    </div>
                                    <div class="card d-inline-flex mb-2">
                                        <div class="card-body bg-light py-2 px-3">
                                            {{ $comment->content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- / .card-body -->
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('report.comment.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <strong>Leave a Comment</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="report" value="{{ $report->id }}" required>
                                <textarea name="content" id="content" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
