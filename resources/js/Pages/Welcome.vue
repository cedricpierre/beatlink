<script lang="ts" setup>
import {Head, Link} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {useAsset} from "@/Compasable/asset";

const asset = useAsset()
</script>

<template>
    <Head title="Welcome"/>
    <DefaultLayout>
        <div class="text-center py-8 mb-12">

            <h1 class="text-primary-600 dark:text-primary-200 font-extrabold text-7xl my-8">BeatLink.</h1>
            <h2 class="text-primary-900 dark:text-primary-500 font-bold text-4xl my-8">Music marketing, without headache ! 🤘</h2>
            <h3 class="text-gray-600 dark:text-primary-700 text-xl my-6">Engage people and grow your audience</h3>

            <Link class="my-4" :href="route('register')">
                <Button size="lg" class="text-bold">Register your 7 days trial</Button>
            </Link>
            <div class="py-4">
                <strong class="text-xs text-gray-400">No credit card required. ✅</strong>
            </div>

        </div>

        <div class="container mx-auto mt-12">
            <div class="columns-1 lg:columns-2 gap-4">

                <div class="relative">
                    <img class="rounded-xl shadow w-40 z-0 blur absolute top-10 right-0" :src="asset('img/screenshot.png')" alt="">
                    <img class="rounded-xl shadow w-40 z-0 blur absolute top-20 left-0" :src="asset('img/screenshot.png')" alt="">
                    <div class="z-20 w-full relative z-10">
                        <img class="rounded-xl mx-auto shadow-2xl w-60" :src="asset('img/screenshot.png')" alt="">
                    </div>
                </div>
                <div class="px-8 py-8">
                    <h3 class="text-gray-600 text-lg lg:text-2xl text-center">
                        Create your own landing page and promote your artists.
                    </h3>

                    <div class="columns-3 gap-2 lg:gap-4 my-8 space-y-6">
                        <div
                            class="bg-white w-full flex items-center justify-center flex-col px-4 py-2 rounded-2xl shadow border border-primary-100 text-center">
                            <img class="h-12 w-12" :src="asset('brands/spotify.svg')" alt="Spotify">
                            <h4 class="text-primary-800 pt-4 pb-2 text-md lg:text-xl">Spotify</h4>
                        </div>
                        <div
                            class="bg-white w-full flex items-center justify-center flex-col px-4 py-2 rounded-2xl shadow border border-primary-100 text-center">
                            <img class="h-12 w-12" :src="asset('brands/tidal.svg')" alt="Spotify">
                            <h4 class="text-primary-800 pt-4 pb-2 text-md lg:text-xl">Tidal</h4>
                        </div>
                        <div
                            class="bg-white w-full flex items-center justify-center flex-col px-4 py-2 rounded-2xl shadow border border-primary-100 text-center">
                            <img class="h-12 w-12" :src="asset('brands/deezer.svg')" alt="Spotify">
                            <h4 class="text-primary-800 pt-4 pb-2 text-md lg:text-xl">Deezer</h4>
                        </div>
                    </div>

                    <p class="my-8 text-center text-gray-600">
                        Share your pages on social medias like Facebook, Tiktok or Instagram. Get insight and statistic about your campaigns.
                    </p>
                    <p class="text-center my-8">
                        <Link :href="route('register')">
                            Register now
                        </Link>
                    </p>
                    <p class="text-center text-gray-300">Register now and try one campaign during 7 days.</p>
                </div>
            </div>
        </div>

    </DefaultLayout>
</template>
