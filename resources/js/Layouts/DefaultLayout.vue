<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Background from "@/Components/Background.vue";
import {FwbButton, FwbNavbar, FwbNavbarCollapse, FwbNavbarLink} from "flowbite-vue";
</script>

<template>
    <Background>
        <fwb-navbar>
            <template #logo>
                <ApplicationLogo/>
            </template>
            <template #default="{isShowMenu}">
                <fwb-navbar-collapse :is-show-menu="isShowMenu">
                    <fwb-navbar-link is-active link="#">
                        How it works
                    </fwb-navbar-link>
                    <fwb-navbar-link link="#">
                        Pricing
                    </fwb-navbar-link>
                    <fwb-navbar-link link="#">
                        About us
                    </fwb-navbar-link>
                    <fwb-navbar-link link="#">
                        Contact
                    </fwb-navbar-link>

                </fwb-navbar-collapse>
            </template>
            <template #right-side>
                <fwb-navbar-collapse>
                    <fwb-navbar-link :link="route('register')">
                        <fwb-button>Register</fwb-button>
                    </fwb-navbar-link>
                    <fwb-navbar-link :link="route('login')">
                        <fwb-button>Login</fwb-button>
                    </fwb-navbar-link>
                </fwb-navbar-collapse>


            </template>
        </fwb-navbar>

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
