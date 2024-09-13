<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {ref} from 'vue';
import Card from "@/Components/Card.vue";
import Input from "@/Components/Input.vue";
import Modal from "@/Components/Modal.vue";

const confirmingDeletion = ref(false);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingDeletion.value = true;
};

const destroy = () => {
    form.post(route('subscriptions.cancel'), {
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
            If you choose to cancel your subscription, your campaigns will be terminated too. But you will still have access to your account and no data will
            be lost. You can resume anytime.
        </template>

        <Button class="mt-4" variant="error" @click="confirmUserDeletion">Cancel subscription</button>

        <Modal v-model="confirmingDeletion">
            <template #header>
                Are you sure you want to cancel your subscription ?
            </template>
            <template #body>

                <p class="mt-1 text-sm text-primary-600 dark:text-primary-400">
                    If you choose to cancel your subscription, your campaigns will be terminated too.
                </p>

                <div class="mt-6">
                    <Input
                        v-model="form.password"
                        :error-message="form.errors.password"
                        :validation-status="form.errors.password ? 'error' : 'success'"
                        label="Password"
                        placeholder="Password"
                        type="password"
                        @keyup.enter="destroy"
                    />
                </div>
            </template>
            <template #footer>
                <Button @click="closeModal"> Cancel</button>
                <Button :disabled="form.processing" :loading="form.processing"
                        class="ms-3"
                        variant="error"
                        @click="destroy"
                >
                    Cancel subscription
                </button>
            </template>
        </Modal>
    </Card>
</template>
