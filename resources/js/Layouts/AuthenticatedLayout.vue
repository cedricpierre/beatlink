<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link} from '@inertiajs/vue3';
import Background from "@/Components/Background.vue";
import {FwbListGroup, FwbListGroupItem, FwbNavbar, FwbNavbarCollapse, FwbNavbarLink} from "flowbite-vue";
import {UserIcon} from '@heroicons/vue/16/solid'
import Footer from "@/Components/Footer.vue";
import Dropdown from "@/Components/Dropdown.vue";
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
                <Dropdown align="end">
                    <template #trigger>
                        <button class="btn btn-primary">
                            <div class="flex flex-row items-center justify-center">
                                <UserIcon class="h-5 mr-2"></UserIcon>
                                <span>{{ $page.props.auth.user.name }}</span>
                            </div>
                        </button>
                    </template>
                    <li>
                            <Link :href="route('profile.edit')">Profile</Link>
                    </li>
                    <li>
                            <Link :href="route('logout')" method="post" as="button">Log Out</Link>
                    </li>
                </Dropdown>
            </template>
        </fwb-navbar>

        <!-- Page Heading -->
        <header
            class="h-20 flex items-center bg-blue-900 text-white dark:bg-blue-600 dark:text-white "
            v-if="$slots.header"
        >
            <div class="flex flex-row items-center container mx-auto lg:max-w-screen-lg px-2">
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
