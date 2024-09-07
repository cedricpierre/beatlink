<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Background from "@/Components/Background.vue";
import Footer from "@/Components/Footer.vue";
import BCard from "@/Components/BCard.vue";
</script>

<template>
    <Background>
        <div class="flex justify-center items-center flex-col flex-1">
            <div class="container w-1/4">
                <ApplicationLogo class="text-center text-2xl mb-2"/>

                <BCard>
                    <slot/>
                </BCard>

                <Footer></Footer>
            </div>
        </div>
    </Background>
</template>
