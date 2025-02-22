<template>
    <div class="btn">
        <button class="btn__buy text-[#FFF] bg-[#987F2D] h-[35px] w-[7.043rem] flex justify-center items-center gap-3 hover:bg-[#b8982c] noto-sans-devanagari-regular">
            <img v-if="icon" :src="icon" alt="Product Image" :class="imgClass">
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
    }
}
</script>

<style>
    .btn button img{
        width: 0.984rem;
        height: 0.833rem;
    }
</style>