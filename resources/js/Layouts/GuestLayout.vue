<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Background from "@/Components/Background.vue";
import Footer from "@/Components/Footer.vue";
import Card from "@/Components/Card.vue";
</script>

<template>
    <Background>
        <div class="flex justify-center items-center flex-col flex-1">
            <div class="container w-1/4">
                <ApplicationLogo class="text-center text-2xl mb-2"/>

                <Card>
                    <slot/>
                </Card>

                <Footer></Footer>
            </div>
        </div>
    </Background>
</template>
