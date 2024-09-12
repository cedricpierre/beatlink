<script setup lang="ts">
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
    <Head :title="props.campaign.name"></Head>
    <Background
        class="flex flex-col min-h-screen">
        <div class="fixed top-0 left-0 w-full h-full z-0 blur bg-cover opacity-20" v-if="props.campaign.background_url"
             :style="{backgroundImage:`url(/storage/${props.campaign.background_url})`}"></div>

        <div class="py-8 px-4 z-1 fixed top-0 left-0 w-full h-full overflow-auto flex flex-col  justify-center">
            <div class="flex flex-col max-w-screen-sm mx-auto h-full w-full">

                <div class="flex flex-col flex-grow items-center justify-center">
                    <div class="animation-fade-in delay-200 leading-tight font-extrabold text-3xl text-center mb-4 text-black dark:text-white">{{
                            props.campaign.name
                        }}
                    </div>
                    <div v-if="props.campaign.description"
                         class="animation-fade-in delay-400 leading-tight font-light text-xl text-center mb-4 text-black dark:text-white">{{
                            props.campaign.description
                        }}
                    </div>
                    <div class="animation-fade-in delay-400 w-full flex justify-center my-8" v-if="props.campaign.image_url">
                        <img :src="`/storage/${props.campaign.image_url}`" class="w-60 h-60 object-cover rounded-2xl shadow-2xl"
                             alt="">
                    </div>

                    <ul class="min-w-80 flex justify-center flex-col">
                        <li v-for="link in props.campaign.links" :key="link.id" class="w-full my-2">
                            <a
                                class="btn btn-neutral w-full h-full justify-start px-6 py-4 rounded-xl "
                                :href="route('landing.open',{campaign: props.campaign.slug, link: link.platform_id})">

                                <div class="flex flex-row items-center">
                                    <div class="h-6 flex" v-html="link.platform.icon"></div>
                                    <h3 class="ml-3 text-xl leading-tight">
                                        {{ link.platform.name }}
                                    </h3>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex shrink-0 justify-center flex-col mt-4">
                    <div class="mb-2 text-center">
                        <a href="/"
                           class="btn btn-sm btn-outline btn-primary text-sm"
                           target="_blank">Make a
                            page</a>
                    </div>
                    <Footer></Footer>
                </div>
            </div>
        </div>
    </Background>
</template>

<style scoped lang="scss">
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
