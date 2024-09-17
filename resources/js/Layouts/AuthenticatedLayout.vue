<script lang="ts" setup>
import {Link, usePage} from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";
import Badge from "@/Components/Badge.vue";
import {IUser} from "@/Interfaces/User";
import Navbar from "@/Components/Navbar.vue";
import moment from "moment/moment";

const user = usePage().props.auth.user as IUser
</script>

<template>
    <Background>

        <Navbar class="bg-white">
            <template #left>
                <Logo/>
            </template>
            <template #responsive>
                <li>
                    <Link :href="route('dashboard')">Dashboard</Link>
                </li>
                <li>
                    <Link :href="route('campaigns.list')">Campaigns</Link>
                </li>
            </template>
            <template #center>
                <li>
                    <Link :href="route('dashboard')">Dashboard</Link>
                </li>
                <li>
                    <Link :href="route('campaigns.list')">Campaigns</Link>
                </li>
            </template>
            <template #right>
                <li v-if="user.is_subscribed && !user.is_premium">
                    <Link :href="route('subscriptions.subscribe')" class="bg-primary-600 text-white hover:bg-primary-100 hover:text-primary-600">
                        Subscribe now
                    </Link>
                </li>
                <li>
                    <Dropdown align="end">
                        <template #trigger>
                            <div>
                                <Badge v-if="user.is_premium" class="uppercase mr-2" size="sm">
                                        premium
                                    </Badge>
                                    <strong class="first-letter:uppercase font-bold">{{ user.name }}</strong>
                            </div>
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
            </template>
        </Navbar>
        <!-- Page Heading -->
        <header
            v-if="$slots.header"
            class="py-4 flex items-center bg-gradient-to-r from-primary-900 to-primary-700 dark:bg-black dark:bg-opacity-10 text-primary-100 dark:text-white "
        >
            <div class="flex flex-row container mx-auto lg:max-w-screen-lg p-2">
                <div class="flex flex-1 items-center flex-col md:flex-row space-y-2 lg:space-y-0">
                    <div class="flex justify-center items-center w-full flex-col md:justify-start lg:flex-row">
                        <span v-if="$slots.header" class="leading-tight font-extrabold font-2xl">
                            <slot name="header"/>
                        </span>
                        <span v-if="$slots.subtitle" class="ml-4 font-sm text-primary-300">
                            <slot name="subtitle"/>
                        </span>
                    </div>
                    <div v-if="$slots.actions" class="flex flex-grow space-x-2 justify-center md:justify-end w-full">
                        <slot name="actions"/>
                    </div>
                </div>
            </div>
        </header>

        <div class="container mx-auto my-4 lg:max-w-screen-sm" v-if="user.is_trial">
            <Alert variant="success">
                You are on your trial period until: <strong>{{ moment(user.trial_ends_at).format('DD-MM-YYYY') }}</strong>

                <template #action>
                    <Link :href="route('subscriptions.subscribe')" class="btn btn-success btn-sm">Subscribe</Link>
                </template>
            </Alert>
        </div>

        <!-- Page Content -->
	    <main class="container px-2 my-4 mx-auto">
            <slot/>
        </main>

        <Footer></Footer>
    </Background>
</template>
