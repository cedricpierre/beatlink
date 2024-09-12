<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";
import Badge from "@/Components/Badge.vue";
</script>

<template>
    <Background>
        <div class="navbar bg-white dark:bg-black dark:bg-opacity-30">
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
                    <ul class="menu menu-horizontal justify-end space-x-2">
                        <li v-if="$page.props.auth.user.is_subscribed && !$page.props.auth.user.is_premium">
                            <Link class="bg-blue-600 text-white hover:bg-blue-100 hover:text-blue-600">Subscribe now</Link>
                        </li>
                        <li>
                            <Dropdown align="right">
                                <template #trigger>
                                    <Badge size="sm" outline variant="primary" v-if="$page.props.auth.user.is_premium" class="uppercase mr-2">premium</Badge>
                                    <strong class="first-letter:uppercase font-bold">{{ $page.props.auth.user.name }}</strong>
                                </template>
                                <li>
                                    <Link class="text-blue-600" :href="route('profile.edit')">Profile</Link>
                                </li>
                                <li>
                                    <Link class="text-blue-600" :href="route('subscriptions.edit')">Subscription</Link>
                                </li>
                                <li>
                                    <Link class="text-blue-600" :href="route('logout')" method="post" as="button">Log Out</Link>
                                </li>
                            </Dropdown>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <header
            class="h-20 flex items-center bg-blue-700 dark:bg-black dark:bg-opacity-10 text-blue-100 dark:text-white "
            v-if="$slots.header"
        >
            <div class="flex flex-row items-center container mx-auto lg:max-w-screen-lg px-2">
                <div class="flex flex-1 items-center">
                    <div class="flex space-between items-center">
                        <span class="leading-tight font-extrabold font-2xl" v-if="$slots.header">
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

        <div class="container mx-auto mt-4 lg:max-w-screen-sm">
            <Alert v-if="$page.props.auth.user.is_trial">
                You are on your trial period.

                <template #action>
                    <Link method="post" as="button" class="btn btn-error btn-sm" :href="route('subscriptions.cancel')">Cancel</Link>
                </template>
            </Alert>
        </div>

        <!-- Page Content -->
        <main class="container mx-auto mt-4">
            <slot/>
        </main>

        <Footer></Footer>
    </Background>
</template>
