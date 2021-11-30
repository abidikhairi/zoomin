@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('assign-president.save') }}" method="post">
                    @csrf
                    <input type="hidden" name="room" value="{{ $room->id }}">
                    <div class="card">
                        <div class="card-header">
                            {{ ('تعيين رئيس الغرفة') }}
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <label for="room_president">{{ ('رئيس الغرفة') }}</label>
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
