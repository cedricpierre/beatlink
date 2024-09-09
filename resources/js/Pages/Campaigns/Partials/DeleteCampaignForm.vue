<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import {ref} from 'vue';
import {FwbButton, FwbModal} from "flowbite-vue";
import Card from "@/Components/Card.vue";
import {ICampaign} from "@/Interfaces/Campaign";

const confirmingDeletion = ref(false);

const props = defineProps<{
    campaign: ICampaign
}>()

const confirmDeletion = () => {
    confirmingDeletion.value = true;
};

</script>

<template>
    <Card>
        <template #header>
            Delete campaign
        </template>

        <template #subtitle>
            Once your campaign is deleted, all of its resources and data will be permanently deleted. Before deleting
            your campaign, be sure you wish to retain.
        </template>

        <button class="btn btn-error mt-4" @click="confirmDeletion">Delete campaign</button>

        <fwb-modal v-if="confirmingDeletion" @close="confirmingDeletion = false">
            <template #header>
                <h2>
                    Are you sure you want to delete?
                </h2>
            </template>
            <template #body>
                Once deleted, you cannot undo this action.
            </template>
            <template #footer>
                <button class="btn btn-secondary" @click="confirmingDeletion = false"> Cancel</button>
                <button class="btn btn-error ms-3"
                >
                    <Link :href="route('campaigns.destroy', {campaign: props.campaign?.id})" method="delete" as="button">
                        Delete
                    </Link>
                </button>
            </template>
        </fwb-modal>
    </Card>
</template>
