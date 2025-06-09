<template>
  <img
    :src="'/build/client/images/newslleter.png'"
    alt="Newsletter Background"
    class="absolute top-0 left-0 w-full h-full object-cover z-[-1]"
    loading="lazy"
    decoding="async"
  />

  <div class="m-auto w-[90%] max-w[79.188rem] h-[100%] flex justify-center items-end flex-col">
    <h4 class="noto-sans-devanagari-medium text-[1.125rem] sm:text-[2.5rem] text-[#FFF]">Inscreva-se</h4>
    <p class="noto-sans-devanagari-thin text-[0.75rem] sm:text-[1.125rem] text-[#FFF]">Receba novidades e descontos exclusivos </p>

    <form @submit.prevent="submitForm" class="flex flex-col items-end gap-3 w-full max-w-full mt-[1rem] sm:max-w-[414px] md:max-w-[530px]">
        <input v-model="form.name" type="text" required name="name" placeholder="Nome completo" class="h-[35px] w-full noto-sans-devanagari-thin text-[#000] text-[0.75rem] ps-[1.125rem] focus-visible:border-[#CF1E0C] focus-visible:outline-none border border-gray-300">
        <input v-model="form.email" type="email" required name="email" placeholder="E-mail" class="h-[35px] w-full noto-sans-devanagari-thin text-[#000] text-[0.75rem] ps-[1.125rem] focus-visible:border-[#CF1E0C] focus-visible:outline-none border border-gray-300">

      <button-component :icon="'/build/client/images/heart.png'" :label="'Enviar!'"></button-component>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';

const toast = useToast();

export default {
  data() {
    return {
      form: {
        name: '',
        email: ''
      }
    };
  },
  methods: {
    async submitForm() {
      try {
        await axios.post('/enviar-formulario', this.form);
        toast.success(`Inscrição enviada com sucesso!`, {
            timeout: 3000,
            position: 'top-right',
            closeOnClick: true,
            pauseOnHover: true,
        });
        this.form.name = '';
        this.form.email = '';
      } catch (error) {
        toast.error(`Não foi possível enviar sua inscrção!`, {
            timeout: 3000,
            position: 'top-right',
            closeOnClick: true,
            pauseOnHover: true,
        });
      }
    }
  }
};
</script>


<style>
    /* .newlleter{
        background-image: url('../../assets/client/images/newslleter.png');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    } */
    .newlleter::after{
        content: '';
        background-image: url('../../assets/client/images/firula-news.png');
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
</style>