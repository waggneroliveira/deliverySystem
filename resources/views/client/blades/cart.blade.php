@extends('client.core.client')

@section('content')
    <section id="banner-inner">
        <banner-inner-component></banner-inner-component>
    </section>
    <section id="cart">
        <div class="flex flex-row justify-between items-start m-auto w-[90%] max-w[79.188rem] mt-[65.67px] mb-[65.67px]">
            <div class="w-full max-w-[364px]">
                <order-summary-component></order-summary-component>
            </div>
            <div class="w-[70%]">
                <cart-component></cart-component>
            </div>
        </div>
    </section>
@endsection