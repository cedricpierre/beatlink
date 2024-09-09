<script setup lang="ts">
import {ICampaign} from "@/Interfaces/Campaign";
import {Head} from "@inertiajs/vue3";
import {FwbButton} from "flowbite-vue";
import Footer from "@/Components/Footer.vue";

const props = defineProps<{
    campaign: ICampaign
}>()

</script>
<template>
    <Head :title="campaign.name"></Head>
    <div
        class="flex flex-col min-h-screen bg-gray-100 from-gray-100 to-white bg-gradient-to-br dark:from-gray-950 dark:to-gray-800 py-8 px-2">
        <div class="animation-fade-in fixed top-0 left-0 w-full h-full z-0 blur-2xl bg-cover opacity-10" v-if="campaign.background_url"
             :style="{backgroundImage:`url(/storage/${campaign.background_url})`}"></div>

        <div class="z-1 fixed top-0 left-0 w-full h-full overflow-auto flex flex-col  justify-center">
            <div class="flex flex-col max-w-screen-sm mx-auto h-full w-full">

                <div class="flex flex-col flex-grow items-center justify-center">
                    <div class="animation-fade-in delay-200 leading-tight font-extrabold text-3xl text-center mb-4 text-black dark:text-white">{{
                            campaign.name
                        }}
                    </div>
                    <div class="animation-fade-in delay-400 w-full flex justify-center my-6" v-if="campaign.image_url">
                        <img :src="`/storage/${campaign.image_url}`" class="w-80 h-80 object-cover rounded-2xl shadow"
                             alt="">
                    </div>

                    <ul class="w-full flex justify-center flex-col">
                        <li v-for="link in campaign.links" :key="link.id" class="w-full my-2">
                            <a
                                class="px-6 py-4 rounded-xl shadow block dark:bg-white dark:text-black dark:hover:bg-black dark:hover:text-white bg-black text-white hover:text-black hover:bg-white"
                                :href="route('landing.open',{campaign: campaign.slug, link: link.platform_id})">

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
                           class="border-2 py-2 px-4 rounded text-black border-black dark:border-white hover:text-white hover:border-white dark:text-white dark:hover:text-black dark:hover:border-black text-sm"
                           target="_blank">Make a
                            page</a>
                    </div>
                    <Footer></Footer>
                </div>
            </div>
        </div>
    </div>
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
