<template>
    <div class="flex flex-row items-center pt-[1.875rem] sm:pt-[43px] pb-[1.875rem] sm:pb-[43px]">
        <div class="back">
            <a href="/" class="text-[#FFF] rounded text-[0.75rem] px-3 sm:px-[1.125rem] bg-[#987F2D] h-[30px] sm:h-[35px] w-auto sm:w-[7.043rem] flex justify-center items-center hover:bg-[#b8982c] noto-sans-devanagari-regular">Voltar</a>
        </div>
        <form action="" method="POST" class="flex flex-row items-end gap-0 w-full max-w-full sm:max-w-[414px] md:max-w-[430px]">
            <input type="text" name="search" placeholder="Pesquise aqui" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="h-[30px] sm:h-[35px] w-full noto-sans-devanagari-thin text-[#000] text-[0.625rem] sm:text-[0.75rem] ps-[1.125rem] focus-visible:border-[#CF1E0C] focus-visible:outline-none borde border-white ">

            <button-component :img-class="'object-contain aspect-[1/1] !w-[10px]'" @click.prevent :class="'w-auto gap-1 pointer-events-none'" :icon="'/build/client/images/lupa.png'"></button-component>
        </form>
    </div>
</template>
<script setup>
    defineProps(['modelValue']);
    defineEmits(['update:modelValue']);
</script>
