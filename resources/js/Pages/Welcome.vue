<script lang="ts" setup>
import {Head, Link} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {useAsset} from "@/Compasable/asset";

const asset = useAsset()
</script>

<template>
    <Head title="Welcome"/>
    <DefaultLayout>
        <div class="container mx-auto lg:max-w-screen-lg text-center py-8 mb-12">

            <h1 class="text-primary-600 dark:text-primary-200 font-extrabold text-7xl my-8">BeatLink.</h1>
            <h2 class="text-primary-900 dark:text-primary-500 font-bold text-4xl my-8">Music app pages, without headache ! 🤘</h2>
            <h3 class="text-gray-500 dark:text-primary-700 text-xl my-6">Engage people and grow your audience</h3>

            <Link class="btn btn-success btn-lg my-4" :href="route('register')">
                Register your 7 days trial
            </Link>
            <div>
                <strong class="leading-tight text-gray-400">No credit card required. ✅</strong>
            </div>

        </div>

        <div class="container mx-auto mt-12">
            <div class="columns-1 lg:columns-2 gap-4">

                <div class="relative">
                    <img class="rounded-xl shadow w-40 z-0 blur absolute top-10 right-0" :src="asset('img/screenshot.png')" alt="">
                    <img class="rounded-xl shadow w-40 z-0 blur absolute top-20 left-0" :src="asset('img/screenshot.png')" alt="">
                    <div class="z-20 w-full relative z-10">
                        <img class="rounded-xl mx-auto  shadow w-60" :src="asset('img/screenshot.png')" alt="">
                    </div>
                </div>
                <div class="px-8 py-8">
                    <h3 class="text-primary-800 text-xl text-center">
                        Create your own landing page and promote your artists.
                    </h3>

                    <div class="md:columns-3 columns-1 gap-8 my-8 space-y-6">
                        <div class="w-full flex items-center justify-center flex-col p-4 rounded-2xl border border-gray-200 bg-white text-center">
                            <img class="h-8 w-8" :src="asset('brands/spotify.svg')" alt="Spotify">
                            <h4 class="text-primary-600 py-4 text-xl">Spotify</h4>
                        </div>
                        <div class="w-full flex items-center justify-center flex-col p-4 rounded-2xl border border-gray-200 bg-white text-center">
                            <img class="h-8 w-8" :src="asset('brands/tidal.svg')" alt="Spotify">
                            <h4 class="text-primary-600 py-4 text-xl">Tidal</h4>
                        </div>
                        <div class="w-full flex items-center justify-center flex-col p-4 rounded-2xl border border-gray-200 bg-white text-center">
                            <img class="h-8 w-8" :src="asset('brands/deezer.svg')" alt="Spotify">
                            <h4 class="text-primary-600 py-4 text-xl">Deezer</h4>
                        </div>
                    </div>

                    <p class="my-8 text-center text-gray-400">
                        Share your pages on social medias like Facebook, Tiktok or Instagram. Get insight and statistic about your campaigns.
                    </p>
                    <p class="text-center my-8">
                        <Link class="btn btn-primary" :href="route('register')">
                            Register now
                        </Link>
                    </p>
                    <p class="text-center text-gray-300">Register now and try one campaign during 7 days.</p>
                </div>
            </div>
        </div>

    </DefaultLayout>
</template>
