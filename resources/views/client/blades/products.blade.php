@extends('client.core.client')

@section('content') 
    <section id="banner-inner">
        <banner-inner-component></banner-inner-component>
    </section>

    <section id="products-inner" class="relative flex justify-center items-center">
        <div class="m-auto w-[90%] max-w[79.188rem] mt-[65.67px] mb-[65.67px]">
            <h1 class="text-[#CF1E0C] text-[1.875rem] noto-sans-devanagari-extrabold">SACHIMI</h1>
            <div class="filter">
                <product-filter-component></product-filter-component>
            </div>

            <products-component></products-component>
        </div>
    </section>
@endsection
