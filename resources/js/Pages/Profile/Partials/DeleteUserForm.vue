<script setup lang="ts">
import {useForm} from '@inertiajs/vue3';
import {ref} from 'vue';
import Card from "@/Components/Card.vue";
import Input from "@/Components/Input.vue";
import Modal from "@/Components/Modal.vue";

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

        <Button variant="error" class="mt-4" @click="confirmUserDeletion">Delete Account</button>

        <Modal v-model="confirmingDeletion">
            <template #header>
                Are you sure you want to delete your account?
            </template>
            <template #body>

                <p class="mt-1 text-sm text-blue-600 dark:text-blue-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <Input
                        label="Password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        placeholder="Password"
                        @keyup.enter="destroy"
                        :validation-status="form.errors.password ? 'error' : 'success'"
                        :error-message="form.errors.password"
                    />
                </div>
            </template>
            <template #footer>
                <Button @click="closeModal"> Cancel</button>
                <Button variant="error" class="ms-3"
                        :loading="form.processing"
                        :disabled="form.processing"
                        @click="destroy"
                >
                    Delete Account
                </button>
            </template>
        </Modal>
    </Card>
</template>
