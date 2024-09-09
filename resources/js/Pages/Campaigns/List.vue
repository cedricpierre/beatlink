<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {FwbButton, FwbTable, FwbTableBody, FwbTableCell, FwbTableHead, FwbTableHeadCell, FwbTableRow} from "flowbite-vue";
import {ICampaign} from "@/Interfaces/Campaign";
import {IPaginate} from "@/Interfaces/Paginate";
import BPagination from "@/Components/Pagination.vue";
import moment from 'moment'
import DeleteCampaignForm from "@/Pages/Campaigns/Partials/DeleteCampaignForm.vue";

const props = defineProps<{
    campaigns: IPaginate<ICampaign>;
}>();
</script>

<template>

    <Head title="Campaigns"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>Campaigns</h2>
        </template>
        <template #subtitle>
            <p>Create or update your campaigns</p>
        </template>
        <template #actions>
            <Link :href="route('campaigns.create')">
                <button class="btn btn-primary">
                    Create new campaign
                </button>
            </Link>
        </template>
        <fwb-table>
            <fwb-table-head>
                <fwb-table-head-cell>Name</fwb-table-head-cell>
                <fwb-table-head-cell>Slug</fwb-table-head-cell>
                <fwb-table-head-cell class="text-center">Links</fwb-table-head-cell>
                <fwb-table-head-cell>Created at</fwb-table-head-cell>
                <fwb-table-head-cell class="text-center">Total views</fwb-table-head-cell>
                <fwb-table-head-cell class="text-center">Total leads</fwb-table-head-cell>
                <fwb-table-head-cell class="text-center" title="Conversion rate">CR</fwb-table-head-cell>
                <fwb-table-head-cell class="text-right">Actions</fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>
                <fwb-table-row v-for="campaign in $props.campaigns.data" :key="campaign.id">
                    <fwb-table-cell>{{ campaign.name }}</fwb-table-cell>
                    <fwb-table-cell>
                        <a class="text-blue-600 hover:underline" :href="route('landing', {slug: campaign.slug})" target="_blank">
                            {{ campaign.slug }}
                        </a>
                    </fwb-table-cell>
                    <fwb-table-cell class="text-center">{{ campaign.links_count }}</fwb-table-cell>
                    <fwb-table-cell>{{ moment(campaign.created_at).format('YYYY-MM-DD HH:mm') }}</fwb-table-cell>
                    <fwb-table-cell class="text-center">{{ campaign.views_count }}</fwb-table-cell>
                    <fwb-table-cell class="text-center">{{ campaign.leads_count }}</fwb-table-cell>
                    <fwb-table-cell class="text-center">{{ campaign.conversion_rate }}%</fwb-table-cell>
                    <fwb-table-cell class="space-x-2 whitespace-nowrap">
                        <Link :href="route('campaigns.view', {id: campaign.id})">
                            <button class="btn btn-secondary">
                                View
                            </button>
                        </Link>
                        <Link :href="route('campaigns.edit', {id: campaign.id})">
                            <button class="btn btn-primary">
                                Edit
                            </button>
                        </Link>

                    </fwb-table-cell>
                </fwb-table-row>
            </fwb-table-body>
        </fwb-table>

        <BPagination :paginated="$props.campaigns"></BPagination>

    </AuthenticatedLayout>
</template>
