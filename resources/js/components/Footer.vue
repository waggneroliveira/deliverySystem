<template>
    <div class="footer__content flex flex-full flex-col items-center justify-between m-auto w-[90%] max-w[79.188rem] h-full">
        <div class="grid grid-cols-1 sm:grid-cols-3 sm:items-center md:grid-cols-4 gap-4 w-full items-start">
            <div class="footer__content--image w-[90px]">
                <img :src="logoPath" alt="Sushitan">
            </div>
            <div class="footer__content--sitemap flex justify-center mt-[25px]">
                <nav>
                    <h6 class="text-[#E2E3DE] text-[1.375rem] noto-sans-devanagari-regular">Sitemap</h6>
                    <ul class="flex flex-col gap-5 mt-5">
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-thin"><a href="">Encomendas personalizadas</a></li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-thin"><a href="">Forneça um feedback</a></li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-thin"><a href="">Política de devolução</a></li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-thin"><a href="">Política de Privacidade</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer__content--contact flex justify-end mt-[25px]">
                <nav>
                    <h6 class="text-[#E2E3DE] text-[1.375rem] noto-sans-devanagari-regular">Contato</h6>
                    <ul class="flex flex-col gap-5 mt-5">
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-thin">
                            <a href="" class="flex flex-row items-center justify-center gap-4">
                                <img :src="location" alt="">
                                <span>Onde atendemos</span>
                            </a>
                        </li>
                        <li class="text-[#E2E3DE] text-[1.25rem] noto-sans-devanagari-thin">
                            <a href="" class="flex flex-row items-center justify-center gap-4">
                                <img :src="phone" alt="">
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
                        <a :v-if="link" :href="link"><img :src="icon.path" :alt="icon.alt" :title="icon.name"></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="copyright w-full flex flex-row justify-between items-center mt-[72px] mb-[53px]">
            <p class="noto-sans-devanagari-thin text-[1rem] text-[#E2E3DE]">Sushitan &copy;{{ currentYear }}. all right reserved</p>

            <img :src="logoFooter" alt="WHI" title="WHI - Web de alta Inspiração" class="w-[88px]">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentYear: new Date().getFullYear(),
                logoPath: '/build/client/images/logo.png',
                location: 'build/client/images/location.png',            
                phone: 'build/client/images/phone.png',
                logoFooter: 'build/client/images/logo-footer.svg',
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