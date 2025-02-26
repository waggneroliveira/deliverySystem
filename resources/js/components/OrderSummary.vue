<template>
    <div class="order-summary bg-[#031D40] text-white p-4 w-full relative">
        <span class="rounded-full bg-[#CF1E0C] w-[41px] h-[41px] absolute top-[-20px] left-1/2 transform -translate-x-1/2"></span>

        <div class="w-[90%] m-auto pt-[41px] pb-[25px]">
            <h2 class="text-center text-lg text-[1.25rem] noto-sans-devanagari-semibold mb-4">Resumo do pedido</h2>
            
            <div class="flex justify-between mb-3 pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[1.125rem] text-[#FFF]">Produtos:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[1.125rem]">€ 177,00</span>
            </div>
            
            <div class="flex justify-between mb-3 pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[1.125rem] text-[#FFF]">Troco:</span>
                <span class="bg-[#987F2D] text-white px-4 py-0 leading-[23px]">Sim</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[1.125rem]">€ 15,00</span>
            </div>
            
            <div class="flex justify-between pb-3 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-medium text-[1.125rem] text-[#FFF]">Taxa:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[1.125rem]">€ 72,00</span>
            </div>
            
            <div class="flex justify-between mt-5 mb-4 pt-2 border-b border-[#DAAB22]">
                <span class="noto-sans-devanagari-semibold text-[1.375rem] text-[#FFF]">Total:</span>
                <span class="noto-sans-devanagari-semibold text-[#FFF] text-[1.375rem]">€ 87,00</span>
            </div>
            
            <div class="mb-4 gap-7 flex justify-between items-baseline">
                <span class="inline-block noto-sans-devanagari-medium text-[1.125rem] text-[#FFF]">Entrega:</span>
                <span class="text-sm noto-sans-devanagari-light text-[#FFF]">Apartado 1, Freixo de Espada À Cinta 5181-909 FREIXO DE ESPADA À CINTA</span>
            </div>
            
            <div class="flex justify-center items-center mt-9 btn-go">
                <button class="w-full max-w-[141.1px] bg-[#CF1E0C] hover:bg-red-700 text-white py-2 rounded font-bold">Avançar</button>
            </div>
        </div>
    </div>
</template>
