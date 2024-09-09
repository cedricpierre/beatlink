<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Background from "@/Components/Background.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <Background>
        <div class="navbar bg-base-100">
            <div class="container mx-auto lg:max-w-screen-lg">
                <div class="flex shrink-0 mr-2">
                    <ApplicationLogo/>
                </div>
                <div class="flex flex-grow">
                    <ul class="menu menu-horizontal space-x-2">
                        <li><a>Pricing</a></li>
                        <li><a>How it works</a></li>
                    </ul>
                </div>
                <div class="flex justify-end">
                    <ul class="menu menu-horizontal space-x-2">
                        <li>
                            <Link :href="route('register')" class="btn btn-primary btn-outline">Register</Link>
                        </li>
                        <li>
                            <Link :href="route('login')" class="btn btn-primary">Login</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <header class="bg-white dark:bg-blue-800 shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot/>
        </main>
    </Background>
</template>
