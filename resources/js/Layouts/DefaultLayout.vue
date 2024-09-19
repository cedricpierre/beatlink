<script lang="ts" setup>
import {Link, usePage} from "@inertiajs/vue3";
import {IUser} from "@/Interfaces/User";
import Navbar from "@/Components/Navbar.vue";
import {useAsset} from "@/Compasable/asset";

const user = usePage().props.auth.user as IUser

const asset = useAsset()
</script>

<template>
    <Background class="bg-no-repeat bg-top"
                :style="{
            backgroundImage: `url(${asset('img/bg.png')})`,
        }"
    >
        <Navbar variant="primary" sticky position="top" shadow>
            <template #left>
                <Logo/>
            </template>
            <template #responsive>
                <li><a>Pricing</a></li>
                <li><a>How it works</a></li>
            </template>
            <template #center>
                <li><a>Pricing</a></li>
                <li><a>How it works</a></li>
            </template>
            <template #right>
                <template v-if="!user">
                    <li>
                        <Link class="text-primary" :href="route('register')">Register</Link>
                    </li>
                    <li>
                        <Link :href="route('login')">Login</Link>
                    </li>
                </template>
                <template v-else>
                    <li>
                        <Link :href="route('dashboard')" class="btn btn-primary">Dashboard</Link>
                    </li>
                </template>
            </template>
        </Navbar>

        <header v-if="$slots.header" class="bg-white dark:bg-primary-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <main class="container px-2 mx-auto lg:max-w-screen-lg">
            <slot/>
        </main>
    </Background>
</template>
