@extends('layouts.app')

@section('content')
    <div class="post">
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <x-post :bulletin="$bulletin">
            @include('bulletin.slots.'.$slot)
        </x-post>
    </div>
@endsection
