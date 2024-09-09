<script setup lang="ts">
import {useForm} from '@inertiajs/vue3';
import {nextTick, ref} from 'vue';
import {FwbButton, FwbInput, FwbModal} from "flowbite-vue";
import Card from "@/Components/Card.vue";

const confirmingDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingDeletion.value = true;
};

const destroy = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    confirmingDeletion.value = false;

    form.reset();
};
</script>

<template>
    <Card>
        <template #header>
            Delete Account
        </template>

        <template #subtitle>
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
            your account, please download any data or information that you wish to retain.
        </template>

        <button class="btn btn-error mt-4" @click="confirmUserDeletion">Delete Account</button>

        <fwb-modal v-if="confirmingDeletion" @close="closeModal">
            <template #header>
                <h2>
                    Are you sure you want to delete your account?
                </h2>
            </template>
            <template #body>

                <p class="mt-1 text-sm text-blue-600 dark:text-blue-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <fwb-input
                        label="Password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        placeholder="Password"
                        @keyup.enter="destroy"
                    />
                </div>
            </template>
            <template #footer>
                <button class="btn btn-secondary" @click="closeModal"> Cancel</button>
                <button class="btn btn-error ms-3"
                            :loading="form.processing"
                            :disabled="form.processing"
                            @click="destroy"
                >
                    Delete Account
                </button>
            </template>
        </fwb-modal>
    </Card>
</template>
