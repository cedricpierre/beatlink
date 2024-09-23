<script lang="ts" setup>
import {Link, usePage} from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";
import Badge from "@/Components/Badge.vue";
import {IUser} from "@/Interfaces/User";
import Navbar from "@/Components/Navbar.vue";
import moment from "moment/moment";
import NavbarItem from "@/Components/NavbarItem.vue";
import DropdownItem from "@/Components/DropdownItem.vue";

const user = usePage().props.auth?.user as IUser
</script>

<template>
    <Background>

        <Navbar variant="white" sticky position="top" shadow>
            <template #left>
                <Logo/>
            </template>
            <template #responsive>
                <DropdownItem>
                    <Link :href="route('dashboard')">Dashboard</Link>
                </DropdownItem>
                <DropdownItem>
                    <Link :href="route('campaigns.list')">Campaigns</Link>
                </DropdownItem>
            </template>
            <template #center>
                <NavbarItem>
                    <Link :href="route('dashboard')">
                        Dashboard
                    </Link>
                </NavbarItem>
                <NavbarItem>
                    <Link :href="route('campaigns.list')">
                        Campaigns
                    </Link>
                </NavbarItem>
            </template>
            <template #right>
                <NavbarItem v-if="user.is_subscribed && !user.is_premium">
                    <Link :href="route('subscriptions.subscribe')">
                        Subscribe now
                    </Link>
                </NavbarItem>
                <Dropdown align="right">
                        <template #trigger>
                            <NavbarItem>
                                <Badge variant="primary" v-if="user.is_premium" class="uppercase mr-2" size="xs">
                                    premium
                                </Badge>
                                <strong class="first-letter:uppercase font-bold">{{ user.name }}</strong>
                            </NavbarItem>
                        </template>
                    <DropdownItem>
                        <Link :href="route('profile.edit')">Profile</Link>
                    </DropdownItem>
                    <DropdownItem>
                        <Link :href="route('subscriptions.edit')">Subscription</Link>
                    </DropdownItem>
                    <DropdownItem>
                        <Link :href="route('logout')" method="post">Log Out</Link>
                    </DropdownItem>
                    </Dropdown>

            </template>
        </Navbar>
        <!-- Page Heading -->
        <header
            v-if="$slots.header"
            class="py-4 flex items-center bg-gradient-to-r from-primary-900 to-primary-700 dark:bg-black dark:bg-opacity-10 text-primary-100 dark:text-white "
        >
            <div class="flex flex-row container mx-auto p-2">
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
                    <Link size="sm" :href="route('subscriptions.subscribe')">
                        <Button variant="success">
                            Subscribe
                        </Button>
                    </Link>
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
