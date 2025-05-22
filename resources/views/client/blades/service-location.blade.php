@extends('client.core.client')

@section('content')
    <div class="bg-[#d9d9d94f]">
        <section id="banner-inner">
            <banner-inner-component 
                :image="'{{ asset('/build/client/images/banner-inner-1.png') }}'" 
                :title="'Locais de atendimento'">
            </banner-inner-component>
        </section>
        <section id="service-location" class="relative overflow-hidden">
            <img src="{{asset('/build/client/images/firula-loctation-left.png')}}" alt="Firula left" class="absolute left-0 top-[-180px]">
            <div class="service-location-content flex flex-row flex-wrap gap-x-[60px] gap-y-[30px] justify-center items-center m-auto w-[90%] max-w[79.188rem] pt-[1.25rem] sm:pt-[65.67px] pb-[25px] sm:pb-[65.67px]">
                <service-location></service-location>
            </div>
            <img src="{{asset('/build/client/images/firula-location-rigth.png')}}" alt="Firula rigth" class="absolute right-0 top-0">
        </section>
    </div>
@endsection
