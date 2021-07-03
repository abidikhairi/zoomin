@extends('layouts.member')

@section('content')
    <div class="container-fluid">
        <div id="claim-table-app" data-room-president="{{ $roomPresident->id }}">
        </div>
    </div>
@endsection
