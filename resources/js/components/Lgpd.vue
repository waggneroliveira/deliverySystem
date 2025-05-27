<template>
  <div id="mySidenav" class="fixed top-0 left-0 h-full w-0 opacity-0 z-50 bg-white overflow-x-hidden transition-all duration-500 pl-14 pt-7 pr-2" :class="{'w-[480px] opacity-100': sidenavOpen}">
    <a href="javascript:void(0)" class="absolute top-0 right-6 text-[36px] ml-12 transition-colors hover:text-[#051920]" @click="closeNav">&times;</a>
    <div class="border-b border-[#18283b38] mb-5 pb-3">
      <img width="120" :src="'/build/client/images/logo.png'" alt="">
    </div>
    <div class="overflow-y-scroll h-[654px] mb-0">
      <h3 class="font-bold text-lg mb-2">Política Privacidade</h3>
      <p class="leading-6 mb-2 text-sm">
        A sua privacidade é importante para nós. É política do respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site , e outros sites que possuímos e operamos.
        Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado.
      </p>
      <p class="leading-6 mb-2 text-sm">
        Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.
      </p>
      <p class="leading-6 mb-2 text-sm">
        Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não possamos fornecer alguns dos serviços desejados.
      </p>
      <p class="leading-6 mb-2 text-sm">
        Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.
      </p>
      <h3 class="font-bold text-lg mt-4 mb-2">Política de Cookies</h3>
      <p class="leading-6 mb-2 text-sm">
        Como é prática comum em quase todos os sites profissionais, este site usa cookies, que são pequenos arquivos baixados no seu computador, para melhorar sua experiência. Esta página descreve quais informações eles coletam, como as usamos e por que às vezes precisamos armazenar esses cookies. Também compartilharemos como você pode impedir que esses cookies sejam armazenados, no entanto, isso pode fazer o downgrade ou 'quebrar' certos elementos da funcionalidade do site.
      </p>
      <div class="mt-4">
        <h3 class="font-bold text-base mb-2">Gerenciar preferências de consentimento</h3>
        <label class="block font-bold text-[#18283b] mb-5 text-[15px]" title="Necessário para que o site funcione corretamente" for="necessarily">Necessário
          <input class="checkbox align-middle ml-2" id="necessarily" type="checkbox" data-function="necessarily">
        </label>
        <label class="block font-bold text-[#18283b] mb-5 text-[15px]" title="Necessário para salvar suas preferências de site, por exemplo, lembrar seu nome de usuário, etc." for="useAnalysis"> Preferências do site
          <input class="checkbox align-middle ml-2" id="useAnalysis" type="checkbox" data-function="useAnalysis">
        </label>
        <label class="block font-bold text-[#18283b] mb-5 text-[15px]" title="Necessário para coletar visitas ao site, tipos de navegador, etc." for="analytics">Analytics
          <input class="checkbox align-middle ml-2" id="analytics" type="checkbox" data-function="analytics" >
        </label>
        <label class="block font-bold text-[#18283b] mb-5 text-[15px]" title="Obrigatório para marketing, por exemplo, boletins informativos, mídia social, etc." for="marketing">Marketing
          <input class="checkbox align-middle ml-2" id="marketing" type="checkbox" data-function="marketing" >
        </label>
      </div>
    </div>
    <div class="flex justify-center mt-6">
      <button class="button_modal_req_cookie bg-[#b8982c] border border-[#b8982c] rounded-full cursor-pointer px-8 py-2 text-white font-normal text-[15px] font-poppins transition hover:bg-transparent hover:text-[#b8982c]" @click="handlePref">Confirme Minhas Escolhas</button>
    </div>
  </div>
  <div class="cookies-container fixed bottom-0 left-1/2 -translate-x-1/2 w-[calc(100%-220px)] h-[100px] z-[10000] bg-gradient-to-r from-[#031D40] via-[#0a2c5c] to-[#3a4e6d] flex items-center justify-center">
    <div class="cookie-content flex flex-wrap items-center justify-center gap-x-8 h-full w-full">
      <h5 class="text-white w-[70%] text-[14px] font-medium">
        Ao clicar em “Prosseguir”, você concorda com o armazenamento de cookies em seu dispositivo para melhorar a navegação no site, analisar o uso do site e auxiliar nos serviços de marketing. <b><a target="_blank" class="underline" href="https://policies.google.com/technologies/cookies?hl=pt-BR">Aviso de Cookie</a></b>
      </h5>
      <div class="cookies-pref flex items-center">
        <button class="save_cookie_button bg-[#b8982c] border border-[#b8982c] rounded-full cursor-pointer px-8 py-2 text-white font-normal text-[15px] font-poppins transition hover:bg-transparent hover:text-[#b8982c]" @click="handleSaveAll">PROSSEGUIR</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const sidenavOpen = ref(false);

function openNav() {
  sidenavOpen.value = true;
}

function closeNav() {
  sidenavOpen.value = false;
}

function getFormSelectedAll() {
  const list = document.getElementsByClassName("checkbox");
  const arr = [];
  for (let index = 0; index < list.length;) {
    list[index].setAttribute('checked','checked');
    const result = list[index].getAttribute('data-function');
    ++index;
    arr.push(result);
  }
  return arr;
}

function getFormPref() {
  return [...document.querySelectorAll('[data-function]')].filter((el)=> el.checked
  ).map((el)=>el.getAttribute('data-function'));
}

function activeAllCookie(allCookie) {
  allCookie.forEach(f => functions[f] && functions[f]());
  document.querySelector('.cookies-container').style.display = 'none';
  closeNav();
  window.localStorage.setItem('cookies', JSON.stringify(allCookie));
}

function activePrefCookie(prefCookie) {
  prefCookie.forEach(f => functions[f] && functions[f]());
  document.querySelector('.cookies-container').style.display = 'none';
  closeNav();
  window.localStorage.setItem('cookies-pref', JSON.stringify(prefCookie));
}

function handleSaveAll() {
  const allCookie = getFormSelectedAll();
  activeAllCookie(allCookie);
}

function handlePref() {
  const prefCookie = getFormPref();
  activePrefCookie(prefCookie);
}

const functions = {
  necessarily() {},
  useAnalysis() {},
  analytics() {
    window.dataLayer = window.dataLayer || [];
    function gtag(){window.dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-687157588');
  },
  marketing() {}
};

onMounted(() => {
  const container = document.querySelector('.cookies-container');
  const localPref = JSON.parse(window.localStorage.getItem('cookies-pref'));
  const localAllCookie = JSON.parse(window.localStorage.getItem('cookies'));
  if(localPref) activePrefCookie(localPref);
  if(localAllCookie) activeAllCookie(localAllCookie);
});
</script>
