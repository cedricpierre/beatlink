<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import {IPlatform} from "@/Interfaces/Platform";
import {FwbButton} from "flowbite-vue";

const props = defineProps<{
    campaign: ICampaign;
}>()
</script>
<template>

    <Head title="Campaigns"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>View campaign</h2>
        </template>
        <template #subtitle>
            <p>View your campaign "<strong>{{ campaign.name }}</strong>"</p>
        </template>
        <template #actions>
            <Link :href="route('campaigns.edit', {campaign: campaign.id})" target="_blank">
                <Button variant="primary">
                    Edit campain
	            </button>
            </Link>
        </template>

        <div class="container lg:max-w-screen-sm mx-auto">

        </div>
    </AuthenticatedLayout>
</template>

