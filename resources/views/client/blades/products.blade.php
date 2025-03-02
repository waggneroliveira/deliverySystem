@extends('client.core.client')

@section('content') 
    <section id="banner-inner">
        <banner-inner-component 
            :image="'{{ asset('/build/client/images/banner-inner-1.png') }}'" 
            :title="'Escolha seu Sushi abaixo'">
        </banner-inner-component>
    </section>

    <section id="products-inner" class="relative flex justify-center items-center">
        <div class="m-auto w-[90%] max-w[79.188rem] mt-[1.25rem] sm:mt-[65.67px] mb-[2.188rem] sm:mb-[65.67px]">
            <h1 class="text-[#CF1E0C] text-[1.125rem] sm:text-[1.875rem] uppercase noto-sans-devanagari-extrabold">SACHIMI</h1>
            <div class="filter">
                <product-filter-component></product-filter-component>
            </div>

            <products-component></products-component>
        </div>
    </section>
@endsection
