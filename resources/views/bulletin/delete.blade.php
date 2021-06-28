@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <h2 class="mb-5 text-green"><b>{{ $bulletin->title }}</b></h2>
    </div>
    <p>
        {{ $bulletin->body }}
    </p>
    <div class="">
        <p class="text-lgray">Date:{{ $bulletin->created_at }}</p>
    </div>
    <hr>
    <div class="row justify-content-between">
        <form action="{{ route('bulletin.delete', ['bulletin' => $bulletin->id]) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit">Yes</button>
        </form>
        <a href="{{ url('bulletin?page=' . $currentPage) }}">
            <button type="submit">cancel</button>
        </a>
    </div>
@endsection
