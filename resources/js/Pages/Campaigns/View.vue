<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import {ILead} from "@/Interfaces/Lead";
import Pagination from "@/Components/Pagination.vue";
import {PropType, ref} from "vue";
import {IPaginated} from "@/Interfaces/Paginated";
import Input from "@/Components/Input.vue";
import {IPlatform} from "@/Interfaces/Platform";

const props = defineProps({
    campaign: Object as PropType<ICampaign>,
    platforms: Array<IPlatform>,
    leads: Object as PropType<IPaginated<ILead>>,
    search: String,
    platform_id: String,
})

const columns = ref([
    {key: 'platform', name: 'Platform'},
    {key: 'ip', name: 'IP'},
    {key: 'user_agent', name: 'user_agent'},
    {key: 'referer', name: 'Referer'},
    {key: 'actions', name: 'Actions', align: 'right'},
])

const form = useForm({
    search: props.search,
    platform_id: props.platform_id,
})
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
            <Link class="btn btn-primary" :href="route('campaigns.edit', {campaign: campaign.id})" target="_blank">
                Edit campain
            </Link>
            <a :href="route('landing', {slug: props.campaign.slug})" target="_blank">
                <Button>
                    View page
                </button>
            </a>
        </template>

        <div class="container mx-auto">
            <Card>
                <template #header>
                    <div class="flex flex-row space-between items-center">
                        <h2 class="flex flex-grow">{{ props.leads.total }} leads</h2>
                        <div class="flex flex-shrink">
                            <form @submit.prevent="form.get(route('campaigns.view',{campaign: campaign.id}))">
                                <div class="flex flex-row space-x-2">
                                    <Select :options="props.platforms" value-key="id" text-key="name" v-model="form.platform_id"/>
                                    <Input type="search" v-model="form.search" placeholder="Search"></Input>
                                    <Button variant="primary">Ok</Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>

                <Table :columns="columns" :items="props.leads?.data">
                    <template #item.platform="{item}">
                        {{ item.platform?.name }}
                    </template>

                    <template #item.user_agent="{item}">
                        <span :title="item.user_agent">
                            {{ item.user_agent ? item.user_agent.substring(0, 60) + '...' : '-' }}
                        </span>
                    </template>
                    <template #item.referer="{item}">
                        <span :title="item.referer">
                            {{ item.referer ? item.referer.substring(0, 60) + '...' : '-' }}
                        </span>
                    </template>
                </Table>
            </Card>

            <Pagination :paginated="leads"></Pagination>

        </div>
    </AuthenticatedLayout>
</template>

