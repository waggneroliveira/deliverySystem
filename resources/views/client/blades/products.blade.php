@extends('client.core.client')

@section('content') 
    <section id="banner-inner">
        <banner-inner-component></banner-inner-component>
    </section>

    <section id="products-inner" class="relative flex justify-center items-center">
        <div class="mt-[65.67px] mb-[65.67px]">
            <products-component></products-component>
        </div>
    </section>
@endsection
