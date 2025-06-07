<template>
    <div id="loading-desktop" class="bg-[#041b3d] load-p flex w-screen h-screen" v-show="isLoading">
        <div class="relative w-full h-full">
            <div class="flex flex-col justify-center items-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full">  
                <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-center items-center">
                    <div class="flex flex-col justify-center items-center">
                        <img loading="lazy" :src="'/build/client/images/load-mobile.gif'" class="img-mobile object-cover z-0" alt="">
                        <img loading="lazy" :src="'/build/client/images/logo.png'" class="w-[90px] m-auto z-10" alt="">
                        <div class="load z-20 relative">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isLoading: true
        }
    },
    mounted() {
        // Bloqueia scroll ao iniciar
        document.body.classList.add('no-scroll');

        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.width = '100%';
        document.body.style.height = '100%';

        // window.addEventListener('load', () => {
        //     setTimeout(() => {
        //         this.isLoading = false;
        //         document.body.style.overflow = '';
        //         document.body.style.position = '';
        //         document.body.style.width = '';
        //         document.body.style.height = '';
        //     }, 2500);
        // });
        window.addEventListener('load', () => {
            this.isLoading = false;
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
            document.body.style.height = '';
        });
    }
}
</script>

<style scoped>
    .no-scroll {
        overflow: hidden;
        height: 100vh;
    }
    #loading-desktop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    #loading-desktop[style*="display: none"] {
        opacity: 0;
        visibility: hidden;
    }

    #loading-desktop .img-mobile{
        width: 100%;
        height: auto;
        object-fit: cover;
        object-position: center;
    }
    .img-mobile {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .load {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        position: relative;
        z-index: 20;
    }

    .load span {
        display: block;
        width: 40px;
        height: 10px;
        background: #fff;
        animation: colorSwitch 1.2s infinite;
    }

    .load span:nth-child(2) {
        animation-delay: 0.6s;
    }

    .load span:nth-child(3) {
        animation-delay: 0.9s;
    }

    .img-mobile {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    @keyframes colorSwitch {
        0%, 100% {
            background: #fff;
        }
        50% {
            background: #9E7B32;
        }
    }
    @media (max-width: 680px) {
        .img-mobile {
            display: block;
        }
    }
</style>
