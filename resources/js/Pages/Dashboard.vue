<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, usePage} from '@inertiajs/vue3';
import {ICampaign} from "@/Interfaces/Campaign";
import {PropType, ref} from "vue";
import {ISubscription} from "@/Interfaces/Subscription";
import Badge from "@/Components/Badge.vue";
import {IUser} from "@/Interfaces/User";

const user = usePage().props.auth?.user as IUser

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
        <template #actions>
            <Link :href="route('campaigns.create')">
                <Button variant="ghost">
                    Create new campaign
                </Button>
            </Link>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="col-span-2">
                <Card>
                    <template #header>Latest campains</template>

	                <Table responsive :columns="columns" :items="props.campaigns">
                        <template #item.name="{item}">
                            <Link :href="route('campaigns.view', {campaign: item.id})" class="whitespace-nowrap text-primary-600 hover:underline"
                                  target="_blank">
                                {{ item.name }}
                            </Link>
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
                        <Link :href="route('subscriptions.edit')">
                            <Button size="sm">Upgrade</Button>
                        </Link>
                    </template>
                    <div v-else class="space-y-6">
                        <div>
                            <p>Your subscription is inactive.</p>
                            <p>You need to subscribe to reactivate your campaigns.</p>
                        </div>
                        <Link :href="route('subscriptions.subscribe')">
                            <Button size="sm">Subscribe</Button>
                        </Link>
                    </div>

                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
