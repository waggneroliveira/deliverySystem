<template>
  <button v-show="visible" @click="scrollToTop" class="scroll-up-btn absolute bottom-[125px] sm:bottom-[132px] right-[10px] z-50 bg-[#CF1E0C] text-white p-2 sm:p-3 rounded-t-[20px] shadow-lg hover:bg-[#9E7B32] transition-colors duration-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
    </svg>
  </button>
</template>

<script>
export default {
  data() {
    return {
      visible: false,
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      this.visible = window.scrollY > 200;
    },
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>
