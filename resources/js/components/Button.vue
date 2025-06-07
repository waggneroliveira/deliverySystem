<template>
    <div class="btn">
        <button :class="[btnClass, 'btn__buy rounded text-[#FFF] text-[0.75rem] sm:text-[1.125rem] bg-[#987F2D] h-[30px] sm:h-[35px] w-auto px-3 sm:max-w-[7.043rem] flex justify-center items-center gap-2 sm:gap-3 hover:bg-[#b8982c] noto-sans-devanagari-regular']">
            <img loading="lazy" v-if="icon" :src="icon" alt="Product Image" :class="[imgClass]">
            {{ label }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        icon: String,
        label: String,
        imgClass: String,
        btnClass: String,
    }
}
</script>

<style>
    .btn button img{
        width: 0.984rem !important;
        height: auto;
    }
</style>