<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import {ref} from 'vue';
import {FwbButton, FwbModal} from "flowbite-vue";
import BCard from "@/Components/BCard.vue";
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
    <BCard>
        <template #header>
            Delete campaign
        </template>

        <template #subtitle>
            Once your campaign is deleted, all of its resources and data will be permanently deleted. Before deleting
            your campaign, be sure you wish to retain.
        </template>

        <fwb-button color="red" class="mt-4" @click="confirmDeletion">Delete campaign</fwb-button>

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
                <fwb-button color="alternative" @click="confirmingDeletion = false"> Cancel</fwb-button>
                <fwb-button color="red"
                            class="ms-3"
                >
                    <Link :href="route('campaigns.destroy', {campaign: props.campaign?.id})" method="delete" as="button">
                        Delete
                    </Link>
                </fwb-button>
            </template>
        </fwb-modal>
    </BCard>
</template>
