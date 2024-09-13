<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import {PropType, ref} from 'vue';
import {FwbButton, FwbModal} from "flowbite-vue";
import Card from "@/Components/Card.vue";
import {ICampaign} from "@/Interfaces/Campaign";
import Modal from "@/Components/Modal.vue";

const confirmingDeletion = ref(false);

const props = defineProps({
    campaign: Object as PropType<ICampaign>
})

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

        <Button variant="error" class="mt-4" @click="confirmDeletion">Delete campaign</button>

        <Modal v-model="confirmingDeletion" @close="confirmingDeletion = false">
            <template #header>
                Are you sure you want to delete?
            </template>
            <template #body>
                Once deleted, you cannot undo this action.
            </template>
            <template #footer>
                <Button @click="confirmingDeletion = false"> Cancel</button>
                <Button variant="error" class="ms-3"
                >
                    <Link :href="route('campaigns.destroy', {campaign: props.campaign?.id})" method="delete">
                        Delete
                    </Link>
                </button>
            </template>
        </Modal>
    </Card>
</template>
