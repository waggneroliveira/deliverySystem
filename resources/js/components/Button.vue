<template>
    <div class="btn">
        <button class="btn__buy text-[#FFF] bg-[#987F2D] h-[2.188rem] w-[7.043rem] flex justify-center items-center gap-3 hover:bg-[#b8982c] noto-sans-devanagari-regular">
            <img v-if="icon" :src="icon" alt="Product Image" class="w-[0.984rem] h-[0.833rem]">
            {{ label }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        icon: String, // Apenas como prop
        label: String
    }
}
</script>
