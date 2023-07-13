@extends('layouts.app')

@section('content')

    @php($redirect = redirect()->back()->getTargetUrl())

    {{-- $redirect --}}

    @if(isset($redirect))

        @if (str_contains($redirect, 'miniarmazem'))
            @include('auth.clients.miniarmazem')
        @else
            @include('auth.clients.gandauth')
        @endif
    @else
        @include('auth.clients.gandauth')
    @endif

@endsection
