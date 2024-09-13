<script lang="ts" setup>
import {Head, Link} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
</script>

<template>
    <Head title="Welcome"/>
    <DefaultLayout>
        <div class="container mx-auto lg:max-w-screen-lg">

            <div class="grid grid-flow-col mx-auto my-8">
                <div>
                    <h1 class="text-primary-600 dark:text-primary-200 font-extrabold text-7xl mb-2">BeatLink</h1>
                    <h2 class="text-gray-500 dark:text-primary-500 font-bold text-3xl mb-4">Landing pages Software </h2>
                    <div class="flex align-left">
                        <Link :href="route('register')">
                            <Button size="xl" variant="primary">
                                Register
                            </button>
                        </Link>
                    </div>

                </div>
                <div>

                </div>
            </div>
        </div>

    </DefaultLayout>
</template>
