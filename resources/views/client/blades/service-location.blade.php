@extends('client.core.client')

@section('content')
    <section id="banner-inner">
        <banner-inner-component 
            :image="'{{ asset('/build/client/images/banner-inner-1.png') }}'" 
            :title="'Locais de atendimento'">
        </banner-inner-component>
    </section>
    <section id="service-location">
        <div class="service-location-content flex flex-row flex-wrap gap-[35px] justify-center items-center m-auto w-[90%] max-w[79.188rem] mt-[1.25rem] sm:mt-[65.67px] mb-[25px] sm:mb-[65.67px]">
            <service-location></service-location>
        </div>
    </section>
@endsection
