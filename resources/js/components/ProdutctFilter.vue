<template>
    <div class="flex flex-row items-center pt-[43px] pb-[43px]">
        <div class="back">
            <a href="http://" class="text-[#FFF] bg-[#987F2D] h-[35px] w-[7.043rem] flex justify-center items-center hover:bg-[#b8982c] noto-sans-devanagari-regular">Voltar</a>
        </div>
        <form action="" method="POST" class="flex flex-row items-end gap-0 w-full max-w-full sm:max-w-[414px] md:max-w-[430px]">
            <input type="text" name="search" placeholder="Pesquise aqui" class="border border-white h-[35px] w-full noto-sans-devanagari-thin text-[#000] text-[0.75rem] ps-[1.125rem] focus-visible:border-[#CF1E0C] focus-visible:outline-none border border-gray-300">
            <button-component :img-class="'object-contain aspect-[1/1]'" :icon="'build/client/images/lupa.png'" :label="'Buscar'"></button-component>
        </form>
    </div>
</template>
