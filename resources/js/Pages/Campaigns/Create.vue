<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CampaignInformationForm from "@/Pages/Campaigns/Partials/CampaignInformationForm.vue";

</script>
<template>

    <Head title="Campaigns"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>New campaign</h2>
        </template>
        <template #subtitle>
            <p>Create your new campaign and start sharing your songs</p>
        </template>

        <div class="container lg:max-w-screen-sm mx-auto">
            <CampaignInformationForm @save="$event.post(route('campaigns.create'))"/>
        </div>
    </AuthenticatedLayout>
</template>

