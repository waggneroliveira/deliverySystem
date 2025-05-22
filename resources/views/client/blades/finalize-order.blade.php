@extends('client.core.client')

@section('content')
    <section id="banner-inner">
        <banner-inner-component 
            :image="'{{ asset('/build/client/images/banner-inner-1.png') }}'" 
            :title="'Finalizar Pedido'">
        </banner-inner-component>
    </section>

    <section id="finalize-order">
        <div class="cart-content flex flex-row sm:flex-col md:flex-row xl:flex-row gap-[35px] justify-between items-start m-auto w-[90%] max-w[79.188rem] mt-[1.875rem] sm:mt-[65.67px] mb-[65.67px]">
            <div class="order-summary-content w-full max-w-[364px]">
                <order-summary-component></order-summary-component>
            </div>
            <div class=" finalize-order-component-content w-full">
                <finalize-order-location-component></finalize-order-location-component>
            </div>
        </div>
    </section>
@endsection