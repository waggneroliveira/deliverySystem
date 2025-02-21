@extends('client.core.client')

@section('content')
    <section id="slide">
        <splide-carousel-component></splide-carousel-component> 
    </section>
    {{-- <App/> --}}

    <section id="product__categories" class="flex flex-row flex-wrap content-start xl:justify-center bg-[#031D40]">
        <product-category-component></product-category-component>
    </section>       
    
    <section id="products" class="relative flex justify-center items-center">
        <img src="{{asset('build/client/images/firula-products.png')}}" alt="Firula" class="w-[45px] absolute right-0 top-0">
        <div class="mt-[65.67px] mb-[65.67px]">
            <products-component></products-component>
        </div>
    </section>

    <section id="newslleter" class="newlleter w-full relative z-10">
        <newslleter-component></newslleter-component>
    </section>
    {{-- @inertia --}}
@endsection
