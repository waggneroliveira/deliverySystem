@extends('client.core.client')

@section('content')
    <div class="w-10/12 block m-auto mt-6">
        <header-component></header-component> 
        <App/>            
        {{-- @inertia --}}
    </div>
@endsection
