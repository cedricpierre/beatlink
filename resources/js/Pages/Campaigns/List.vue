<script lang="ts" setup>
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
    {key: 'conversion_rate', name: 'Conversion rate', align: 'center'},
    {key: 'actions', className: 'w-40', align: 'right'},
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
            <Link :href="route('campaigns.create')" class="btn btn-primary">
                Create new campaign
            </Link>
        </template>
        <Card>
            <template #header>
                Campaigns
            </template>
            <Table :columns="columns" :items="props.campaigns?.data">

                <template #item.slug="{item}">
                    <a :href="route('landing', {slug: item.slug})" class="text-primary-600 hover:underline" target="_blank">
                        {{ item.slug }}
                    </a>
                </template>

                <template #item.created_at="{item}">
                    {{ moment(item.created_at).format('YYYY-MM-DD HH:mm') }}
                </template>

                <template #item.views_count="{item}">
                    <Badge outline variant="primary">{{ item.views_count }}</Badge>
                </template>

                <template #item.leads_count="{item}">
                    <Badge outline variant="primary">{{ item.leads_count }}</Badge>
                </template>

                <template #item.conversion_rate="{item}">
                    <Badge outline variant="primary">{{ item.conversion_rate }}%</Badge>
                </template>

                <template #item.actions="{item}">
                    <div class="space-x-2 whitespace-nowrap flex justify-end">
                        <a :href="route('landing', {slug: item.slug})" class="btn btn-sm" target="_blank">
                            View page
                        </a>
                        <Link :href="route('campaigns.view', {id: item.id})" class="btn btn-sm">
                            Stats
                        </Link>
                        <Link :href="route('campaigns.edit', {id: item.id})" class="btn btn-sm btn-primary">
                            Edit
                        </Link>
                    </div>
                </template>

                <template #empty>
                    <div class="flex space-y-6 flex-col justify-center items-center">
                        <span>No item found</span>
                        <Link :href="route('campaigns.create')" class="btn btn-primary btn-sm btn-outline">Create a campaign now</Link>
                    </div>
                </template>
            </Table>
        </Card>

        <BPagination :paginated="props.campaigns"></BPagination>

    </AuthenticatedLayout>
</template>
