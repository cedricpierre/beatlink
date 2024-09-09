<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link} from '@inertiajs/vue3';
import Background from "@/Components/Background.vue";
import {FwbButton, FwbDropdown, FwbListGroup, FwbListGroupItem, FwbNavbar, FwbNavbarCollapse, FwbNavbarLink} from "flowbite-vue";
import {UserIcon} from '@heroicons/vue/16/solid'
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <Background>
        <fwb-navbar>
            <template #logo>
                <ApplicationLogo/>
            </template>
            <template #default="{isShowMenu}">
                <fwb-navbar-collapse :is-show-menu="isShowMenu">
                    <fwb-navbar-link :link="route('campaigns.list')" :is-active="route().current() === 'campaigns.list'">
                        Campaigns
                    </fwb-navbar-link>
                </fwb-navbar-collapse>
            </template>
            <template #right-side>
                <fwb-dropdown text="bottom" align-to-end>
                    <template #trigger>
                        <fwb-button>
                            <div class="flex flex-row align-center justify-center">
                                <UserIcon class="h-4 mr-2"></UserIcon>
                                {{ $page.props.auth.user.name }}
                            </div>
                        </fwb-button>
                    </template>
                    <fwb-list-group>
                        <fwb-list-group-item>
                            <Link :href="route('profile.edit')">Profile</Link>
                        </fwb-list-group-item>
                        <fwb-list-group-item>
                            <Link :href="route('logout')" method="post" as="button">Log Out</Link>
                        </fwb-list-group-item>
                    </fwb-list-group>
                </fwb-dropdown>
            </template>
        </fwb-navbar>

        <!-- Page Heading -->
        <header
            class="h-20 flex items-center bg-blue-900 text-white dark:bg-blue-600 dark:text-white"
                v-if="$slots.header"
        >
            <div class="flex flex-row items-center container mx-auto lg:max-w-screen-lg">
                <div class="flex flex-1 items-center">
                    <div class="flex flex-grow items-center">
                        <span class="leading-tight font-extrabold font-2xl" v-if="$slots.header">
                            <slot name="header"/>
                        </span>
                        <span class="ml-4 font-sm text-blue-300" v-if="$slots.subtitle">
                            <slot name="subtitle"/>
                        </span>
                    </div>
                    <div class="flex shrink-0">
                        <span class="ml-4 font-sm text-blue-300 space-x-2" v-if="$slots.actions">
                            <slot name="actions"/>
                        </span>
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
