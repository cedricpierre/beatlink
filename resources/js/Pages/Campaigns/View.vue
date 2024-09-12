<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import {ILead} from "@/Interfaces/Lead";
import Pagination from "@/Components/Pagination.vue";
import moment from "moment/moment";
import {PropType} from "vue";
import {IPaginated} from "@/Interfaces/Paginated";
import Input from "@/Components/Input.vue";

const props = defineProps({
    campaign: Object as PropType<ICampaign>,
    leads: Object as PropType<IPaginated<ILead>>,
    search: String,
})

const form = useForm({
    search: props.search
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
            <Link :href="route('campaigns.edit', {campaign: campaign.id})" target="_blank">
                <Button variant="primary">
                    Edit campain
                </button>
            </Link>
        </template>

	    <div class="lg:max-w-screen-sm mx-auto">
            <Card>
                <template #header>
                    <div class="flex flex-row space-between items-center">
                        <h2 class="flex flex-grow">Leads</h2>
                        <div class="flex flex-shrink">
                            <form @submit.prevent="form.get(route('campaigns.view',{campaign: campaign.id}))">
                                <div class="flex flex-row space-x-2">
                                    <Input type="search" v-model="form.search" placeholder="Search"></Input>
                                    <Button variant="primary">Ok</Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </template>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Platform</th>
                        <th>IP</th>
                        <th>User agent</th>
                        <th>Referer</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-right">Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="lead in props.leads?.data">
                        <td>{{ lead.platform.name }}</td>
                        <td>{{ lead.ip }}</td>
                        <td><span :title="lead.user_agent">{{ lead.user_agent ? lead.user_agent.substring(0, 20) + '...' : '-' }}</span></td>
                        <td><span :title="lead.referer">{{ lead.referer ? lead.referer.substring(0, 20) + '...' : '-' }}</span></td>
                        <td class="text-center">{{ lead.country ?? '-' }}</td>
                        <td class="text-center">{{ lead.email ?? '-' }}</td>
                        <td class="text-center">{{ lead.name ?? '-' }}</td>
                        <td class="text-center">{{ lead.phone ?? '-' }}</td>
                        <td>{{ moment(lead.created_at).format('YYYY-MM-DD HH:mm') }}</td>
                    </tr>
                    </tbody>
                </table>
            </Card>

            <Pagination :paginated="leads"></Pagination>

        </div>
    </AuthenticatedLayout>
</template>

