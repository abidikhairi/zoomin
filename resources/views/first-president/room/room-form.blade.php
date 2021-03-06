@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('assign-president.save') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            {{ ('تعيين رئيس الدائرة') }}
                        </div>
                        <div class="card-body">
                            <div class="form-row mt-2">
                                <label for="room">{{ __('names.administration.room') }}</label>
                                <select name="room" id="room" class="form-control select2">
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row mt-2">
                                <label for="room_president">{{ ('رئيس الدائرة') }}</label>
                                <select name="room_president" id="room_president" class="form-control select2">
                                    @foreach($presidents as $president)
                                        <option value="{{ $president->id }}">{{ $president->user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                {{ __('forms.fields.accept') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
