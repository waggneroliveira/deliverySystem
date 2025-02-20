@extends('client.core.client')

@section('content')
    <div class="w-10/12 block m-auto">
        <header-component></header-component> 
    </div>
    <section id="slide">
        <splide-carousel></splide-carousel> 
    </section>
    {{-- <App/> --}}

    <section id="product__categories" class="flex flex-row flex-wrap content-start">
        <product-category></product-category>
    </section>        
    {{-- @inertia --}}
@endsection
