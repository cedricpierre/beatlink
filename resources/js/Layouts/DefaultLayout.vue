<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Background from "@/Layouts/Background.vue";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <Background>
        <nav class="dark:bg-purple-800 dark:bg-opacity-10 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('home')" class="mr-4">
                                <ApplicationLogo
                                    class="block h-9 w-auto fill-current text-purple-800 dark:text-purple-200"
                                />
                            </Link>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex items-center flex-1">
                            <NavLink class="mx-4" :href="route('pricings')" :active="route().current('how-it-works')">
                                How it works
                            </NavLink>
                            <NavLink class="mx-4" :href="route('pricings')" :active="route().current('pricings')">
                                Price
                            </NavLink>
                            <NavLink class="mx-4" :href="route('pricings')" :active="route().current('about-us')">
                                About us
                            </NavLink>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link class="dark:text-white text-dark hover:underline" :href="route('register')">Register</Link>
                            <Link :href="route('login')">
                                <PrimaryButton class="ml-4" v-if="!$page.props.authenticated">
                                    Login
                                </PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white dark:bg-purple-800 shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </Background>
</template>
