<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, usePage} from '@inertiajs/vue3';
import {ICampaign} from "@/Interfaces/Campaign";
import {PropType, ref} from "vue";
import {ISubscription} from "@/Interfaces/Subscription";
import Alert from "@/Components/Alert.vue";
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
    {key: 'actions', name: 'Actions', align: 'right'},
])
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>Dashboard</h2>
        </template>

        <div class="lg:max-w-screen-lg mx-auto">
            <div class="flex space-x-4">
                <div class="flex flex-grow">
                    <Card>
                        <template #header>Latest campains</template>

                        <Table :items="props.campaigns" :columns="columns">
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
                                        Page
                                    </a>
                                    <Link class="btn btn-sm" :href="route('campaigns.view', {id: item.id})">
                                        View
                                    </Link>
                                    <Link class="btn btn-sm btn-primary" :href="route('campaigns.edit', {id: item.id})">
                                        Edit
                                    </Link>
                                </div>
                            </template>
                        </Table>
                    </Card>
                </div>
                <div class="flex flex-shrink w-80">
                    <Card>
                        <template #header>
                            Subscription
                        </template>

                        <template v-if="user.is_premium">
                            <div>You are subscribed ! You can create up to {{ props.subscription?.quantity }} campaigns. If you want more, you should consider
                                upgrading your plan.
                            </div>
                            <Link class="btn btn-primary btn-sm" :href="route('subscriptions.edit')">Upgrade</Link>
                        </template>
                        <Alert v-else>
                            Your subscription is canceled. You need to subscribe to reactivate your campaigns.
                            <template #action>
                                <Link class="btn btn-primary btn-sm" :href="route('subscriptions.subscribe')">Subscribe</Link>
                            </template>
                        </Alert>

                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
