<script lang="ts" setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>

    <div>
        <Link :href="route('home')" class="flex justify-center items-center">
            <svg class="animate-pulse w-5 h-5 mr-2 dark:text-white text-primary-600" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M256 80C141.1 80 48 173.1 48 288l0 104c0 13.3-10.7 24-24 24s-24-10.7-24-24L0 288C0 146.6 114.6 32 256 32s256 114.6 256 256l0 104c0
                13.3-10.7 24-24 24s-24-10.7-24-24l0-104c0-114.9-93.1-208-208-208zM80 352c0-35.3 28.7-64 64-64l16 0c17.7 0 32 14.3 32 32l0 128c0 17.7-14.3 32-32 32l-16 0c-35.3 0-64-28.7-64-64l0-64zm288-64c35.3 0 64 28.7 64 64l0 64c0 35.3-28.7 64-64 64l-16 0c-17.7 0-32-14.3-32-32l0-128c0-17.7 14.3-32 32-32l16 0z" fill="#1c64f2"/>
            </svg>
            <h1 class="dark:text-white text-primary-600 py-2 font-extrabold leading-tight">
                BeatLink
            </h1>
        </Link>
    </div>
</template>
