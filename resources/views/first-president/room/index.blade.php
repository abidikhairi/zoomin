@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('List Rooms') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Room President') }}</th>
                                    <th>{{ __('Governorates') }}</th>
                                    <th>{{ __('Magistrates') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->roomPresident->user->name }}</td>
                                    <td>{{ $room->governorates->count() }}</td>
                                    <td>{{ $room->magistrates->count() }}</td>
                                    <td>
                                        <a href="{{ route('first-president.room.assign', ['room' => $room->id]) }}" class="btn btn-primary">
                                            {{ __('Assign President')  }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
