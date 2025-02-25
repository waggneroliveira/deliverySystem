<template>
    <div class="btn">
        <button :class="[btnClass, 'btn__buy text-[#FFF] bg-[#987F2D] h-[35px] w-[7.043rem] flex justify-center items-center gap-3 hover:bg-[#b8982c] noto-sans-devanagari-regular']">
            <img v-if="icon" :src="icon" alt="Product Image" :class="[imgClass]">
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
        width: 0.984rem;
        height: auto;
    }
</style>