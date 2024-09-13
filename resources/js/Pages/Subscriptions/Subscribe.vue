<script lang="ts" setup>
import 'https://js.stripe.com/v3/'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {onMounted, ref} from "vue";
import Alert from "@/Components/Alert.vue";

const props = defineProps({
    stripe_intent: Object,
    stripe_key: String,
})


const form = useForm({
    payment_method: null,
})

let stripe: any, card: any

onMounted(() => {

    const appearance = {
        theme: 'flat',
    }


    // @ts-ignore
    stripe = Stripe(props.stripe_key);

    const elements = stripe.elements({
        clientSecret: props.stripe_intent?.client_secret,
        appearance
    });

    card = elements.create('card')

    card.mount('#card-element');
})

const errors = ref()

const onSubmit = async () => {
    const {setupIntent, error} = await stripe.confirmCardSetup(props.stripe_intent?.client_secret, {
        payment_method: {
            card,
        }
    })

    if (!error) {
        form.payment_method = setupIntent.payment_method
        form.post(route('subscriptions.store'))
    } else {
        errors.value = error
    }
}
</script>

<template>
    <GuestLayout>
        <Head title="Subscribe"/>

        <form class="space-y-6" @submit.prevent="onSubmit">

            <div class="text-gray-500">
                Subscribe now for <strong>3$</strong> per campaign. You will be able to upgrade your subscription later to add more campaigns.
            </div>

            <Alert v-if="errors" variant="error">{{ errors.message }}</Alert>

            <div id="card-element"></div>


            <div class="flex items-center justify-end mt-4">
                <Button :disabled="form.processing" :loading="form.processing" class="ms-3" variant="primary">
                    Subscribe
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
