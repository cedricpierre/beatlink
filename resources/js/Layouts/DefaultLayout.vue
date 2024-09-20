<script lang="ts" setup>
import {Link, usePage} from "@inertiajs/vue3";
import {IUser} from "@/Interfaces/User";
import Navbar from "@/Components/Navbar.vue";
import {useAsset} from "@/Compasable/asset";
import NavbarItem from "@/Components/NavbarItem.vue";

const user = usePage().props.auth.user as IUser

const asset = useAsset()
</script>

<template>
    <Background class="bg-no-repeat bg-top"
                :style="{
            backgroundImage: `url(${asset('img/bg.png')})`,
        }"
    >
        <Navbar variant="white" sticky position="top" shadow>
            <template #left>
                <Logo/>
            </template>
            <template #responsive>
                <li><a>Pricing</a></li>
                <li><a>How it works</a></li>
            </template>
            <template #center>
            </template>
            <template #right>
                <template v-if="!user">
                    <NavbarItem>
                        <Link class="text-primary" :href="route('register')">Register</Link>
                    </NavbarItem>
                    <NavbarItem>
                        <Link :href="route('login')">Login</Link>
                    </NavbarItem>
                </template>
                <template v-else>
                    <NavbarItem>
                        <Link :href="route('dashboard')">Dashboard</Link>
                    </NavbarItem>
                </template>
            </template>
        </Navbar>

        <header v-if="$slots.header" class="bg-white dark:bg-primary-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <main class="container mx-auto lg:max-w-screen-lg">
            <slot/>
        </main>
    </Background>
</template>
