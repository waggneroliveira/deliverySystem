@extends('client.core.client')

@section('content') 
    <section id="banner-inner">
        <banner-inner-component 
            :image="'{{ asset('build/client/images/banner-inner-1.png') }}'" 
            :title="'Escolha seu Sushi abaixo'">
        </banner-inner-component>
    </section>

    <section id="products-inner" class="relative flex justify-center items-center">
        <div class="m-auto w-[90%] max-w[79.188rem] mt-[1.25rem] sm:mt-[65.67px] mb-[2.188rem] sm:mb-[65.67px]">
            <products-component></products-component>
        </div>
    </section>
@endsection
