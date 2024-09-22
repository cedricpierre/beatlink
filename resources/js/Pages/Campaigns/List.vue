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
            <Link :href="route('campaigns.create')">
                <Button variant="ghost">
                    Create new campaign
                </Button>
            </Link>
        </template>
        <Card>
            <template #header>
                Campaigns
            </template>
            <Table responsive :columns="columns" :items="props.campaigns?.data">

                <template #item.name="{item}">
                    <Link :href="route('campaigns.view', {campaign: item.id})" class="whitespace-nowrap text-primary-600 hover:underline" target="_blank">
                        {{ item.name }}
                    </Link>
                </template>
                <template #item.slug="{item}">
                    <a :href="route('landing', {slug: item.slug})" class="whitespace-nowrap text-primary-600 hover:underline" target="_blank">
                        {{ item.slug }}
                    </a>
                </template>
                <template #item.created_at="{item}">
                    <span class="whitespace-nowrap">
                        {{ moment(item.created_at).format('YYYY-MM-DD HH:mm') }}
                    </span>
                </template>
                <template #item.views_count="{item}">
                    <Badge>{{ item.views_count }}</Badge>
                </template>
                <template #item.leads_count="{item}">
                    <Badge>{{ item.leads_count }}</Badge>
                </template>
                <template #item.conversion_rate="{item}">
                    <Badge>{{ item.conversion_rate }}%</Badge>
                </template>
                <template #item.actions="{item}">
                    <div class="space-x-2 whitespace-nowrap flex justify-end">
                        <a :href="route('landing', {slug: item.slug})" target="_blank">
                            <Button variant="light" size="sm">
                                View page
                            </Button>
                        </a>
                        <Link :href="route('campaigns.view', {id: item.id})">
                            <Button variant="light" size="sm">Stats</Button>
                        </Link>
                        <Link :href="route('campaigns.edit', {id: item.id})">
                            <Button size="sm">Edit</Button>
                        </Link>
                    </div>
                </template>
                <template #empty>
                    <div class="flex space-y-6 flex-col justify-center items-center">
                        <span>No campaigns found</span>
                        <Link :href="route('campaigns.create')">
                            <Button size="sm">Create a campaign now</Button>
                        </Link>
                    </div>
                </template>
            </Table>
        </Card>

        <BPagination :paginated="props.campaigns"></BPagination>

    </AuthenticatedLayout>
</template>
