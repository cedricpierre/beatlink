<script lang="ts" setup>
import Footer from "@/Components/Footer.vue";
import Card from "@/Components/Card.vue";
import {useAsset} from "@/Compasable/asset";

const asset = useAsset()
</script>

<template>
    <Background class="bg-no-repeat bg-top"
                :style="{
            backgroundImage: `url(${asset('img/bg.png')})`,
        }"
    >
        <div class="flex justify-center items-center flex-col flex-1">
            <div class="container lg:max-w-screen-sm px-2">
                <Logo class="text-center text-2xl mb-2"/>

                <Card>
                    <slot/>
                </Card>

                <Footer></Footer>
            </div>
        </div>
    </Background>
</template>
