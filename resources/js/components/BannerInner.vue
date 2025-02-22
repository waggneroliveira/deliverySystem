<template>
  <div class="banner-inner h-[540px] w-full relative z-10 flex items-center justify-center text-white text-4xl font-bold">
    <div class="absolute bottom-[75px] flex flex-col h-[60px] m-auto w-[90%] max-w[79.188rem] items-start justify-end gap-4">
        <h1 class="text-[#FFF] text-[2.5rem] noto-sans-devanagari-semibold">Escolha seu Sushi abaixo</h1>
        <span 
        @click="scrollToProducts"
        class="w-0 h-0 border-l-[18px] border-l-transparent cursor-pointer border-r-[18px] border-r-transparent border-t-[25px] border-t-[#CF1E0C] animate-smooth-bounce"></span>
    </div>
  </div>
</template>

<script setup>
  const scrollToProducts = () => {
    setTimeout(() => {
      const targetSection = document.getElementById("products-inner");
      if (targetSection) {
        targetSection.scrollIntoView({ behavior: "smooth" });
      } else {
        console.error("Elemento #products-inner não encontrado.");
      }
    }, 100); // Pequeno delay para garantir que o Vue montou o DOM
  };
</script>

<style>
    .banner-inner{
        background-image: url('../../assets/client/images/banner-inner-1.png');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
    .banner-inner::after{
        content: '';
        background-image: url('../../assets/client/images/firula-banner-inner.png');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        z-index: -1;
    }
    @keyframes smooth-bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(8px);
      }
    }

    .animate-smooth-bounce {
      animation: smooth-bounce 1.5s ease-in-out infinite;
    }

</style>