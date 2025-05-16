<template>
    <div class="footer__content flex flex-full flex-col items-center justify-between h-full">
        <div class="grid grid-cols-1 sm:grid-cols-3 sm:items-center md:grid-cols-4 gap-4 items-start m-auto w-[90%] max-w[79.188rem]">
            <div class="footer__content--image w-[90px] !mt-[25px]">
                <img :src="logoPath" alt="Sushitan">
            </div>
            <div class="footer__content--sitemap flex justify-center mt-[25px]">
                <nav>
                    <h6 class="text-[#E2E3DE] text-[1rem] sm:text-[1.375rem] noto-sans-devanagari-regular">Sitemap</h6>
                    <ul class="flex flex-col gap-2 sm:gap-2 mt-5">
                        <li class="text-[#E2E3DE] text-[0.75rem] sm:text-[0.938rem] noto-sans-devanagari-thin"><a>Encomendas personalizadas</a></li>
                        <li class="text-[#E2E3DE] text-[0.75rem] sm:text-[0.938rem] noto-sans-devanagari-thin"><a>Forneça um feedback</a></li>
                        <li class="text-[#E2E3DE] text-[0.75rem] sm:text-[0.938rem] noto-sans-devanagari-thin"><a>Política de devolução</a></li>
                        <li class="text-[#E2E3DE] text-[0.75rem] sm:text-[0.938rem] noto-sans-devanagari-thin"><a>Política de Privacidade</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer__content--contact flex justify-end mt-[25px] m-auto w-[90%] max-w[79.188rem]">
                <nav>
                    <h6 class="text-[#E2E3DE] text-[1rem] sm:text-[1.375rem] noto-sans-devanagari-regular">Contato</h6>
                    <ul class="flex flex-col gap-2 mt-5">
                        <li class="text-[#E2E3DE] text-[0.75rem] sm:text-[0.938rem] noto-sans-devanagari-thin">
                            <a :href="local" class="flex flex-row items-center justify-center gap-4">
                                <img :src="location" alt="Localização" class="w-[15px]">
                                <span>Onde atendemos</span>
                            </a>
                        </li>
                        <li class="text-[#E2E3DE] text-[0.75rem] sm:text-[0.938rem] noto-sans-devanagari-thin">
                            <a :href="atende" class="flex flex-row items-center justify-center gap-4">
                                <img :src="phone" alt="Telefone" class="w-[10px]">
                                <span>+351 99999-9999</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer__content--social-media flex justify-end mt-[25px] sm:justify-start md:justify-end">
                <nav>
                    <ul class="flex flex-col gap-5">
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-light rounded-full bg-[#9C7831] w-[44px] h-[44px] flex items-center justify-center" 
                        v-for="(icon, index) in socialMedias" :key="index">
                        <a v-if="icon.link" :href="icon.link"><img :src="icon.path" :alt="icon.alt" :title="icon.name"></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="copyright mt-[0px] w-full border-t border-[#ffffff57]">
            <div class="flex flex-row justify-between items-center mt-[40px] mb-[40px] m-auto w-[90%] max-w[79.188rem]">
                <p class="noto-sans-devanagari-thin text-[1rem] text-[#E2E3DE]">Sushitan &copy;{{ currentYear }}. all right reserved</p>

                <img :src="logoFooter" alt="WHI" title="WHI - Web de alta Inspiração" class="w-[88px]">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentYear: new Date().getFullYear(),
                logoPath: '/build/client/images/logo.png',
                location: '/build/client/images/location.png',            
                phone: '/build/client/images/phone.png',
                logoFooter: '/build/client/images/logo-footer.svg',
                local:'#',
                atende:'#',
                socialMedias: [
                    {
                        id: 1,
                        name: 'Instagram',
                        path: '/build/client/images/insta.png',
                        alt: 'Instagram',
                        link:'#',
                    },
                    {
                        id: 2,
                        name: 'whatsapp',
                        path: '/build/client/images/wpp.png',
                        alt: 'Whatsapp',
                        link:'#',
                    },
                    {
                        id: 3,
                        name: 'facebook',
                        path: '/build/client/images/fb.png',
                        alt: 'Facebook',
                        link:'#',
                    },
                ],
            }
        },
    }
</script>

<style>
    @media screen and (max-width: 768px) {
        #footer {
            height: 100% !important;
        }
        #products > img{
            width: 30px;
        }
    }
    @media screen and (max-width: 640px) {
        .footer__content--image,
        .footer__content--contact,
        .footer__content--social-media,
        .footer__content--sitemap{
            margin: 0 auto;
            margin-bottom: 15px;
            justify-content: center;
        }
        .footer__content--image img{
            width: 50px;
            margin: 0 auto;
        }
        .footer__content{
            text-align: center;
        }
        .footer__content--social-media nav ul{
            flex-direction: row;
        }
        .footer__content--social-media nav ul li{
            width: 35px;
            height: 35px;
        }
        .copyright{
            margin: 15px 0;
        }
        .copyright p{
            font-size: 0.75rem;
        }
        .copyright img{
            width: 50px;
        }
    }
</style>