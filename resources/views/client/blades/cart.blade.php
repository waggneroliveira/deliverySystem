@extends('client.core.client')

@section('content')
    <section id="banner-inner">
        <banner-inner-component 
            :image="'{{ asset('/build/client/images/banner-inner-1.png') }}'" 
            :title="'Carrinho'">
        </banner-inner-component>
    </section>
    <section id="cart">
        <div class="cart-content flex flex-row sm:flex-col md:flex-row xl:flex-row gap-[35px] justify-between items-start m-auto w-[90%] max-w[79.188rem] mt-[1.25rem] sm:mt-[65.67px] mb-[25px] sm:mb-[65.67px]">
            <div class="order-summary-content w-full max-w-[364px]">
                <order-summary-component></order-summary-component>
            </div>
            <div class="cart-component-content w-[66%]">
                <cart-component redirect-back="{{ route('products') }}"></cart-component>
            </div>
        </div>
    </section>
@endsection
