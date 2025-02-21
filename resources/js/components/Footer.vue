<template>
    <div class="footer__content flex flex-full flex-col items-center justify-between w-[90%] m-auto">
        <div class="grid grid-cols-4 gap-4 w-full">
            <div class="footer__content--image w-[25%]">
                <img :src="logoPath" alt="Sushitan">
            </div>
            <div class="footer__content--sitemap w-[25%]">
                <nav>
                    <h6 class="text-[#E2E3DE] text-[1.375rem] noto-sans-devanagari-regular">Sitemap</h6>
                    <ul>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light"><a href="">Encomendas personalizadas</a></li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light"><a href="">Forneça um feedback</a></li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light"><a href="">Política de devolução</a></li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light"><a href="">Política de Privacidade</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer__content--contact w-[25%]">
                <nav>
                    <h6 class="text-[#E2E3DE] text-[1.375rem] noto-sans-devanagari-regular">Contato</h6>
                    <ul>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light">
                            <a href="">
                                <img src="" alt="">
                                <span>Onde atendemos</span>
                            </a>
                        </li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light">
                            <a href="">
                                <img src="" alt="">
                                <span>+351 99999-9999</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer__content--social-media w-[25%]">
                <nav>
                    <ul class="flex flex-col gap-3">
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light rounded-full bg-[#9C7831] w-[44px] h-44px" 
                        v-for="(icon, index) in socialMedias" :key="index">
                        <a :v-if="link" :href="link"><img :src="icon.path" :alt="icon.alt" :title="icon.name"></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="copyright w-full">
            <p>&copy; 2023 - Todos os direitos reservados</p>

            <img src="" alt="">
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            logoPath: '/build/client/images/logo.png',
            socialMedias: [
                {
                    id: 1,
                    name: 'Instagram',
                    path: '/build/client/images/insta.png',
                    alt: 'Instagram',
                    link:'https://nekocalc.com/px-to-rem-converter',
                },
                {
                    id: 2,
                    name: 'whatsapp',
                    path: '/build/client/images/wpp.png',
                    alt: 'Whatsapp',
                    link:'',
                },
                {
                    id: 3,
                    name: 'facebook',
                    path: '/build/client/images/fb.png',
                    alt: 'Facebook',
                    link:'',
                },
            ],
        }
    },
}
</script>