<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import {IUser} from "@/Interfaces/User";

const user = usePage().props.auth.user as IUser

</script>

<template>
    <Background>
        <div class="navbar bg-white dark:bg-primary-950">
            <div class="container mx-auto lg:max-w-screen-lg">
                <div class="flex shrink-0 mr-2">
                    <Logo/>
                </div>
                <div class="flex flex-grow">
                    <ul class="menu menu-horizontal space-x-2">
                        <li><a class="text-primary-600">Pricing</a></li>
                        <li><a class="text-primary-600">How it works</a></li>
                    </ul>
                </div>
                <div class="flex justify-end">
                    <ul class="menu menu-horizontal space-x-2">
                        <template v-if="!user">
                            <li>
                                <Link :href="route('register')" class="btn btn-primary btn-outline">Register</Link>
                            </li>
                            <li>
                                <Link :href="route('login')" class="btn btn-primary">Login</Link>
                            </li>
                        </template>
                        <template v-else>
                            <li>
                                <Link :href="route('dashboard')" class="btn btn-primary">Dashboard</Link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <header class="bg-white dark:bg-primary-800 shadow" v-if="$slots.header">
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
