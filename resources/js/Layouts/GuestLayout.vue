<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Background from "@/Layouts/Background.vue";
import Footer from "@/Components/Footer.vue";
import Card from "@/Components/Card.vue";
</script>

<template>
    <Background>
        <div class="flex justify-center items-center flex-col flex-1">
            <div class="container w-1/4">
                <Link :href="route('home')">
                    <ApplicationLogo class="text-center text-2xl mb-2" />
                </Link>
                <Card>
                    <slot />
                </Card>
                <Footer></Footer>
            </div>
        </div>
    </Background>
</template>
