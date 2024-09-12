<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
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
            <template v-if="$page.props.auth.user.can_create_campaign">
                <CampaignInformationForm @save="$event.post(route('campaigns.create'))"/>
            </template>
        </div>
    </AuthenticatedLayout>
</template>

