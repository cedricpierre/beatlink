<script lang="ts" setup>
import {Link, usePage} from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";
import Badge from "@/Components/Badge.vue";
import {IUser} from "@/Interfaces/User";

const user = usePage().props.auth.user as IUser
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
                            <Link :href="route('dashboard')">Dashboard</Link>
                        </li>
                        <li>
                            <Link :href="route('campaigns.list')">Campaigns</Link>
                        </li>
                    </ul>
                </div>
                <div class="flex shrink-0 justify-end">
                    <ul class="menu menu-horizontal justify-end space-x-2">
                        <li v-if="user.is_subscribed && !user.is_premium">
                            <Link :href="route('subscriptions.subscribe')" class="bg-primary-600 text-white hover:bg-primary-100 hover:text-primary-600">
                                Subscribe now
                            </Link>
                        </li>
                        <li>
                            <Dropdown align="right">
                                <template #trigger>
                                    <Badge v-if="user.is_premium" class="uppercase mr-2" outline size="sm" variant="success">
                                        premium
                                    </Badge>
                                    <strong class="first-letter:uppercase font-bold">{{ user.name }}</strong>
                                </template>
                                <li>
                                    <Link :href="route('profile.edit')" class="text-primary-600">Profile</Link>
                                </li>
                                <li>
                                    <Link :href="route('subscriptions.edit')" class="text-primary-600">Subscription</Link>
                                </li>
                                <li>
                                    <Link :href="route('logout')" class="text-primary-600" method="post">Log Out</Link>
                                </li>
                            </Dropdown>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <header
            v-if="$slots.header"
            class="h-20 flex items-center bg-gradient-to-r from-primary-900 to-primary-700 dark:bg-black dark:bg-opacity-10 text-primary-100 dark:text-white "
        >
            <div class="flex flex-row items-center container mx-auto lg:max-w-screen-lg px-2">
                <div class="flex flex-1 items-center">
                    <div class="flex space-between items-center">
                        <span v-if="$slots.header" class="leading-tight font-extrabold font-2xl">
                            <slot name="header"/>
                        </span>
                        <span v-if="$slots.subtitle" class="ml-4 font-sm text-primary-300">
                            <slot name="subtitle"/>
                        </span>
                    </div>
                    <div v-if="$slots.actions" class="flex flex-grow space-x-2 justify-end">
                        <slot name="actions"/>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto mt-4 lg:max-w-screen-sm">
            <Alert v-if="user.is_trial">
                You are on your trial period.

                <template #action>
                    <Link :href="route('subscriptions.cancel')" class="btn btn-error btn-sm" method="post">Cancel</Link>
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
