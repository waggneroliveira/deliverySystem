<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv=X-UA-Compatible content="ie=edge">
        <meta name=theme-color content=#0d0d0d>
        <meta name=description content="O melhor sushi em Cascais, direto à sua porta.Delivery de sushi em Cascais: combinados frescos, entrega ágil e pedido online simples. Experimente!">
        <meta name=keywords content="sushi delivery cascais, delivery de sushi cascais, sushi cascais, encomendar sushi cascais, restaurante de sushi cascais, melhor delivery de sushi em cascais, sushi fresco com entrega em cascais, onde pedir sushi em cascais, sushi takeaway cascais, pedido online de sushi cascais, entrega rápida de sushi cascais, sushi em casa cascais, sushi em cascais com entrega gratuita, comida japonesa cascais, sashimi cascais, combinado sushi cascais, restaurante japonês cascais, sushi barato cascais, sushi premium cascais">
        <title>Sushitan</title>
        <meta property=og:url content=https://www.sushitan.com>
        <meta property=og:type content=website>
        <meta property=og:title content="Sushitan | O Melhor Sushi em Cascais">
        <meta property=og:description content="O melhor sushi em Cascais, direto à sua porta.Delivery de sushi em Cascais: combinados frescos, entrega ágil e pedido online simples. Experimente!">
        <meta name=twitter:card content=summary_large_image>
        <meta name=twitter:url content=https://www.sushitan.com>
        <meta name=twitter:title content="Sushitan | O Melhor Sushi em Cascais">
        <meta name=twitter:description content="O melhor sushi em Cascais, direto à sua porta.Delivery de sushi em Cascais: combinados frescos, entrega ágil e pedido online simples. Experimente!">
        <meta name=twitter:image content=https://www.sushitan.com/build/client/images/logo.png>
        <link rel=canonical href=https://www.sushitan.com/produtos/>
        <meta name=copyright content="Direitos reservados Sushitan">
        <meta name=author content=WHI>
        <link rel="shortcut icon" href=https://www.sushitan.com/build/client/images/favicon.png>
        <!-- Fonts -->
        <link rel="preload" as="style" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
        <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz,wght@16..144,100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Devanagari:wght@100..900&display=swap" />
        <link rel="preload" as="style" href="{{ asset('build/client/css/main.css') }}" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montagu+Slab:opsz,wght@16..144,100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Devanagari:wght@100..900&display=swap" rel="stylesheet">
       
        <link href="{{ asset('build/client/css/main.css') }}" rel="stylesheet" type="text/css" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- YTPlayer Plugin -->
        <script src="https://cdn.jsdelivr.net/npm/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.min.js"></script>

        @if(Route::currentRouteName() !== 'products' || Route::currentRouteName() !== 'finalize-order')
            <style>
                .scrollToProducts, 
                .btn-go{
                    display:none;
                }
            </style>
        @endif

        <style>
            .pagination .carousel__pagination-button{
                background-color: #FFF;
                width: 30px;
            }
            .pagination .carousel__pagination-button--active{
                background-color: #9E7B32;
            }
            .pagination .carousel__pagination-button:hover{
                background-color: #9E7B32;
            }
            
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-white dark:text-black/50">
        <main id="app" class="relative">
            <div class="w-full block m-auto">
                <header-component></header-component> 
            </div>

            @yield('content')
            
            {{-- Carrinho flutuante --}}
            <floating-cart-component></floating-cart-component>

            <lgpd-component></lgpd-component>
            
            <section id="footer" class="w-full h-[390px] bg-[#031D40]">
                <footer-component></footer-component>
            </section>

        </main>
    </body>
</html>
