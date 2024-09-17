<script lang="ts" setup>
import {ICampaign} from "@/Interfaces/Campaign";
import {Head} from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import Background from "@/Components/Background.vue";
import {PropType} from "vue";

const props = defineProps({
    campaign: Object as PropType<ICampaign>
})

</script>
<template>
    <Head :title="props.campaign?.name"></Head>
    <Background
        v-if="props.campaign"
        class="flex flex-col min-h-screen">
        <div v-if="props.campaign.background_url || props.campaign.image_url"
             :style="{backgroundImage:`url(${props.campaign.background_url || props.campaign.image_url})`}"
             class="fixed top-0 left-0 w-full h-full z-0 blur bg-cover opacity-20"></div>

        <div class="py-8 px-4 z-1 fixed top-0 left-0 w-full h-full overflow-auto flex flex-col  justify-center">
            <div class="flex flex-col max-w-screen-sm mx-auto h-full w-full">

                <div class="flex flex-col flex-grow items-center justify-center">
                    <div v-if="props.campaign.image_url" class="animation-fade-in delay-400 w-full flex justify-center my-8">
                        <img :src="`${props.campaign.image_url}`" alt=""
                             class="w-60 h-60 object-cover rounded-2xl shadow-2xl">
                    </div>
                    <div class="animation-fade-in delay-200 leading-tight font-extrabold text-2xl text-center mb-4 text-black dark:text-white">{{
                            props.campaign.name
                        }}
                    </div>
                    <div v-if="props.campaign.description"
                         class="animation-fade-in delay-400 leading-tight font-light text-lg text-center mb-4 text-black dark:text-white">{{
                            props.campaign.description
                        }}
                    </div>

                    <ul class="min-w-80 flex justify-center flex-col">
                        <li v-for="link in props.campaign.links" :key="link.id" class="w-full my-2">
                            <a
                                :href="route('landing.open',{campaign: props.campaign.slug, link: link.platform_id})"
                                class="btn btn-neutral w-full h-full justify-start px-6 py-4 rounded-xl ">

                                <div class="flex flex-row items-center flex-1">
                                    <div class="h-6 flex" v-html="link.platform.icon"></div>
                                    <h3 class="ml-3 flex flex-grow text-xl leading-tight">
                                        {{ link.platform.name }}
                                    </h3>
                                    <div class="flex flex-shrink">
                                        <svg class="h-5" viewBox="0 0 256 512" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex shrink-0 justify-center flex-col mt-4">
                    <div class="mb-2 text-center">
                        <a class="btn btn-sm btn-outline btn-primary text-sm"
                           href="/"
                           target="_blank">Make a
                            page</a>
                    </div>
                    <Footer></Footer>
                </div>
            </div>
        </div>
    </Background>
</template>

<style lang="scss" scoped>
.animation-fade-in {
    animation: fadeInAnimation ease 3s;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
}

@keyframes fadeInAnimation {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>
