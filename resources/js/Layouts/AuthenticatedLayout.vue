<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <Background>
        <div class="navbar bg-gradient-to-br from-bg-white to-bg-blue-100 dark:from-bg-black dark:to-bg-blue-950">
            <div class="container mx-auto  lg:max-w-screen-lg">
                <div class="flex shrink-0 mr-2">
                    <Logo/>
                </div>
                <div class="flex flex-grow">
                    <ul class="menu menu-horizontal space-x-2">
                        <li>
                            <Link class="text-blue-600" :href="route('campaigns.list')">Campaigns</Link>
                        </li>
                    </ul>
                </div>
                <div class="flex shrink-0 justify-end">
                    <ul class="menu menu-horizontal justify-end">
                        <li>
                            <details>
                                <summary class="text-blue-600 bg-blue-100">{{ $page.props.auth.user.name }}</summary>
                                <ul class="bg-base-100 rounded-t-none p-2">
                                    <li>
                                        <Link class="text-blue-600" :href="route('profile.edit')">Profile</Link>
                                    </li>
                                    <li>
                                        <Link class="text-blue-600" :href="route('logout')" method="post" as="button">Log Out</Link>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <header
            class="h-20 flex items-center bg-blue-900 dark:bg-blue-600 dark:text-white "
            v-if="$slots.header"
        >
            <div class="flex flex-row items-center container mx-auto lg:max-w-screen-lg px-2">
                <div class="flex flex-1 items-center">
                    <div class="flex space-between items-center">
                        <span class="leading-tight font-extrabold font-2xl text-white" v-if="$slots.header">
                            <slot name="header"/>
                        </span>
                        <span class="ml-4 font-sm text-blue-300" v-if="$slots.subtitle">
                            <slot name="subtitle"/>
                        </span>
                    </div>
                    <div class="flex flex-grow space-x-2 justify-end" v-if="$slots.actions">
                            <slot name="actions"/>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="container mx-auto mt-4">
            <slot/>
        </main>

        <Footer></Footer>
    </Background>
</template>
