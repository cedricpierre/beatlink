<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, usePage} from '@inertiajs/vue3';
import {ICampaign} from "@/Interfaces/Campaign";
import {PropType, ref} from "vue";
import {ISubscription} from "@/Interfaces/Subscription";
import Badge from "@/Components/Badge.vue";
import {IUser} from "@/Interfaces/User";

const user = usePage().props.auth.user as IUser

const props = defineProps({
    campaigns: Array<ICampaign>,
    subscription: Object as PropType<ISubscription>
})

const columns = ref([
    {key: 'name', name: 'Name'},
    {key: 'leads_count', name: 'Leads', align: 'center'},
    {key: 'views_count', name: 'Views', align: 'center'},
    {key: 'conversion_rate', name: 'CR', align: 'center'},
    {key: 'actions', className: 'w-40', align: 'right'},
])
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>Dashboard</h2>
        </template>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="col-span-2">
                <Card>
                    <template #header>Latest campains</template>

                    <Table :columns="columns" :items="props.campaigns">
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
                                <a :href="route('landing', {slug: item.slug})" class="btn btn-neutral btn-sm" target="_blank">
                                    Page
                                </a>
                                <Link :href="route('campaigns.view', {id: item.id})" class="btn btn-neutral btn-sm">
                                    View
                                </Link>
                                <Link :href="route('campaigns.edit', {id: item.id})" class="btn btn-sm btn-primary">
                                    Edit
                                </Link>
                            </div>
                        </template>
                        <template #empty>
                            <div class="flex space-y-6 flex-col justify-center items-center">
                                <span>No campaigns found</span>
                                <Link :href="route('campaigns.create')" class="btn btn-primary btn-sm btn-outline">Create a campaign now</Link>
                            </div>
                        </template>
                    </Table>
                </Card>
            </div>
            <div class="col-span-1">
                <Card>
                    <template #header>
                        Subscription
                    </template>

                    <template v-if="user.is_premium">
                        <div>You are subscribed ! You can create up to {{ props.subscription?.quantity }} campaigns. If you want more, you should consider
                            upgrading your plan.
                        </div>
                        <Link :href="route('subscriptions.edit')" class="btn btn-primary btn-sm">Upgrade</Link>
                    </template>
                    <div v-else class="space-y-6">
                        <div>
                            <p>Your subscription is inactive.</p>
                            <p>You need to subscribe to reactivate your campaigns.</p>
                        </div>
                        <Link :href="route('subscriptions.subscribe')" class="btn btn-primary btn-sm">Subscribe</Link>
                    </div>

                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
