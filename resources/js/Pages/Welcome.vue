<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

</script>

<template>
    <Head title="Welcome" />
    <DefaultLayout>
        <div class="container mx-auto">

        <div class="grid grid-flow-col w-4/5 mx-auto my-8">
            <div>
                <h1 class="dark:text-purple-200 font-extrabold text-7xl mb-2">BeatLink</h1>
                <h2 class="dark:text-purple-500 font-bold text-3xl mb-4">Music Affiliation Software </h2>
                <div class="flex align-left">
                    <Link :href="route('register')">
                        <PrimaryButton class="my-4">
                            Register
                        </PrimaryButton>
                    </Link>
                    <Link :href="route('pricings')" class="ml-4 self-center text-black dark:text-white">View prices</Link>>
                </div>

            </div>
            <div>
                hello
            </div>
        </div>
        </div>

    </DefaultLayout>
</template>
