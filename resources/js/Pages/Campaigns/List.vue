<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import {IPaginated} from "@/Interfaces/Paginated";
import BPagination from "@/Components/Pagination.vue";
import Card from "@/Components/Card.vue";
import Badge from "@/Components/Badge.vue";
import moment from "moment/moment";
import {PropType} from "vue";

const props = defineProps({
    campaigns: Object as PropType<IPaginated<ICampaign>>,
});
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
            <Link class="btn btn-primary" :href="route('campaigns.create')">
                Create new campaign
            </Link>
        </template>
        <Card>
            <template #header>
                Campaigns
            </template>
            <template #actions>
                <Link class="btn btn-primary" :href="route('campaigns.create')">
                    Create new campaign
                </Link>
            </template>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-center">Links</th>
                    <th>Created at</th>
                    <th class="text-center">Total views</th>
                    <th class="text-center">Total leads</th>
                    <th class="text-center" title="Conversion rate">CR</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="campaign in props.campaigns?.data" :key="campaign.id">
                    <td>{{ campaign.name }}</td>
                    <td>
                        <a class="text-blue-600 hover:underline" :href="route('landing', {slug: campaign.slug})" target="_blank">
                            {{ campaign.slug }}
                        </a>
                    </td>
                    <td class="text-center">{{ campaign.links_count }}</td>
                    <td>{{ moment(campaign.created_at).format('YYYY-MM-DD HH:mm') }}</td>
                    <td class="text-center">
                        <Badge>{{ campaign.views_count }}</Badge>
                    </td>
                    <td class="text-center">
                        <Badge>{{ campaign.leads_count }}</Badge>
                    </td>
                    <td class="text-center">
                        <Badge>{{ campaign.conversion_rate }}%</Badge>
                    </td>
                    <td class="space-x-2 flex justify-end whitespace-nowrap">
                        <Link :href="route('campaigns.view', {id: campaign.id})">
                            <Button variant="neutral">
                                View
                            </button>
                        </Link>
                        <Link :href="route('campaigns.edit', {id: campaign.id})">
                            <Button variant="primary">
                                Edit
                            </button>
                        </Link>

                    </td>
                </tr>
                </tbody>
            </table>
        </Card>

        <BPagination :paginated="props.campaigns"></BPagination>

    </AuthenticatedLayout>
</template>
