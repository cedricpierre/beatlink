<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import {IPaginated} from "@/Interfaces/Paginated";
import BPagination from "@/Components/Pagination.vue";
import Card from "@/Components/Card.vue";
import Badge from "@/Components/Badge.vue";
import moment from "moment/moment";
import {PropType, ref} from "vue";

const props = defineProps({
    campaigns: Object as PropType<IPaginated<ICampaign>>,
});

const columns = ref([
    {key: 'name', name: 'Name'},
    {key: 'slug', name: 'Slug'},
    {key: 'links_count', name: 'Links', align: 'center'},
    {key: 'created_at', name: 'Created at', align: 'center'},
    {key: 'views_count', name: 'Views', align: 'center'},
    {key: 'leads_count', name: 'Leads', align: 'center'},
    {key: 'conversion_rate', name: 'Conversion rate'},
    {key: 'actions', name: 'Actions', align: 'right'},
])
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
            <Table :columns="columns" :items="props.campaigns?.data">

                <template #item.slug="{item}">
                    <a class="text-blue-600 hover:underline" :href="route('landing', {slug: item.slug})" target="_blank">
                        {{ item.slug }}
                    </a>
                </template>

                <template #item.created_at="{item}">
                    {{ moment(item.created_at).format('YYYY-MM-DD HH:mm') }}
                </template>

                <template #item.views_count="{item}">
                    <Badge variant="primary" outline>{{ item.views_count }}</Badge>
                </template>

                <template #item.leads_count="{item}">
                    <Badge variant="primary" outline>{{ item.leads_count }}</Badge>
                </template>

                <template #item.conversion_rate="{item}">
                    <Badge variant="primary" outline>{{ item.conversion_rate }}%</Badge>
                </template>

                <template #item.actions="{item}">
                    <div class="space-x-2 whitespace-nowrap">
                        <a class="btn btn-sm" :href="route('landing', {slug: item.slug})" target="_blank">
                            View page
                        </a>
                        <Link class="btn btn-sm" :href="route('campaigns.view', {id: item.id})">
                            Stats
                        </Link>
                        <Link class="btn btn-sm btn-primary" :href="route('campaigns.edit', {id: item.id})">
                            Edit
                        </Link>
                    </div>
                </template>

                <template #empty>
                    <div class="flex space-y-6 flex-col justify-center items-center">
                        <span>No item found</span>
                        <Link class="btn btn-primary btn-sm btn-outline" :href="route('campaigns.create')">Create a campaign now</Link>
                    </div>
                </template>
            </Table>
        </Card>

        <BPagination :paginated="props.campaigns"></BPagination>

    </AuthenticatedLayout>
</template>
