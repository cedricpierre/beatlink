<script lang="ts" setup>
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import CampaignInformationForm from "@/Pages/Campaigns/Partials/CampaignInformationForm.vue";
import DeleteCampaignForm from "@/Pages/Campaigns/Partials/DeleteCampaignForm.vue";
import CampaignLinksForm from "@/Pages/Campaigns/Partials/CampaignLinksForm.vue";
import CampaignCustomsForm from "@/Pages/Campaigns/Partials/CampaignCustomsForm.vue";
import {IPlatform} from "@/Interfaces/Platform";
import CampaignUploadForm from "@/Pages/Campaigns/Partials/CampaignUploadForm.vue";
import {PropType} from "vue";

const props = defineProps({
    campaign: Object as PropType<ICampaign>,
    platforms: Array<IPlatform>,
})
</script>
<template>

    <Head title="Campaigns"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>Edit campaign</h2>
        </template>
        <template #subtitle>
            <p>Modify your campaign "<strong>{{ props.campaign?.name }}</strong>"</p>
        </template>
        <template #actions>
            <Link :href="route('campaigns.view', {id: props.campaign?.id})">
                <Button variant="ghost">
                    View campain
                </Button>
            </Link>
            <Link :href="route('landing', {slug: props.campaign?.slug})" target="_blank">
                <Button variant="ghost">
                    View page
                </Button>
            </Link>
        </template>

        <div class="lg:max-w-screen-sm mx-auto space-y-6">
            <CampaignInformationForm :campaign="campaign" @save="$event.put(route('campaigns.update',{campaign: props.campaign?.id}))"/>

            <CampaignLinksForm :campaign="campaign" :platforms="platforms"/>

            <CampaignCustomsForm :campaign="campaign"/>

            <CampaignUploadForm :campaign="campaign"/>

            <DeleteCampaignForm :campaign="campaign"/>
        </div>
    </AuthenticatedLayout>
</template>

