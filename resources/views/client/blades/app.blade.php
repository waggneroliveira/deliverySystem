@extends('client.core.client')

@section('content')
    {{-- Load de carregamento --}}
    <load-page-component></load-page-component>
    
    <section id="slide">
        <slide-carousel-component></slide-carousel-component>         
    </section>
    {{-- <App/> --}}

    <section id="product__categories" class="flex flex-row flex-wrap content-start xl:justify-center bg-[#f2f2f2]">
        <product-categories-component></product-categories-component>
    </section>       
    
    <section id="products" class="relative flex justify-center items-center">
        <img src="{{asset('build/client/images/firula-products.png')}}" alt="Firula" class="!w-[20px] sm:w-[45px] absolute right-0 top-0">
        <div class="m-auto w-[90%] max-w[79.188rem] mt-[1.875rem] sm:mt-[65.67px] mb-[1.875rem] sm:mb-[65.67px]">
            <product-box-component></product-box-component>
        </div>
    </section>

    <section id="newslleter" class="newlleter w-full relative z-10">
        <newslleter-component></newslleter-component>
    </section>
@endsection
