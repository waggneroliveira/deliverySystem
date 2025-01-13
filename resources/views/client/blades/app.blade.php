@extends('client.core.client')

@section('content')
    <div class="w-10/12 block m-auto">
        <header-component></header-component> 
    </div>
    <splide-carousel></splide-carousel> 
    <App/>            
    {{-- @inertia --}}
@endsection
