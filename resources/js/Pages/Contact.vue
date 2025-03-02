<script setup>
    import { Head, useForm, usePage } from '@inertiajs/vue3';
    import HeaderText from '@/Components/Texts/HeaderText.vue';
    import DarkGlass from '@/Components/Effects/GlassMorphism/DarkGlass.vue';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import TextInput from '@/Components/Inputs/TextInput.vue';
    import LabelText from '@/Components/Texts/LabelText.vue';
    import FieldMessage from '@/Components/Texts/FieldMessage.vue';
    import TextArea from '@/Components/Inputs/TextArea.vue';
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
    import Modal from '@/Components/Modal.vue';
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
    import { ref } from 'vue';

    const modal = ref({
        show: false,
        type: null,
        message: null,
    });

    const form = useForm({
        full_name: null,
        email: null,
        phone_number: null,
        subject: null,
        message: null
    });

    const send = () => {
        form.post(route('contact.send-email'),  {
            onSuccess: () => {
                modal.value.show = true;
                modal.value.type = 'success';
                modal.value.message = 'Email has been sent successfuly!';
                form.reset();
            },
            onError: () => {
                if (form.errors.failed){
                    modal.value.show = true;
                    modal.value.type = 'error';
                    modal.value.message = form.errors.failed;
                }
            }
        });
    };
</script>

<template>
    <Head title="Contact"/>
    <MarginLayout class="flex flex-grow">
        <DarkGlass class="flex flex-grow justify-center p-2 my-2 border-[1px]">
            <form @submit.prevent="send" class="w-full px-4 pb-2 md:w-1/2">
                <HeaderText class="text-center">Contact <span class="text-green-500">Me</span></HeaderText>

                <LabelText for="full_name" :status="form.errors.full_name ? 'error' : ''">Full Name</LabelText>
                <TextInput id="full_name" placeholder="Full Name" v-model="form.full_name" :status="form.errors.full_name ? 'error' : ''"/>
                <FieldMessage v-if="form.errors.full_name" status="error">{{ form.errors.full_name }}</FieldMessage>

                <LabelText for="email" :status="form.errors.email ? 'error' : ''">Email</LabelText>
                <TextInput id="email" type="email" placeholder="Email" v-model="form.email" :status="form.errors.email ? 'error' : ''"/>
                <FieldMessage v-if="form.errors.email" status="error">{{ form.errors.email }}</FieldMessage>

                <LabelText for="phone_number" :status="form.errors.phone_number ? 'error' : ''">Phone Number</LabelText>
                <TextInput id="phone_number" type="number" placeholder="Phone Number" v-model="form.phone_number" :status="form.errors.phone_number ? 'error' : ''"/>
                <FieldMessage v-if="form.errors.phone_number" status="error">{{ form.errors.phone_number }}</FieldMessage>

                <LabelText for="subject" :status="form.errors.subject ? 'error' : ''">Subject</LabelText>
                <TextInput id="subject" placeholder="Subject" v-model="form.subject" :status="form.errors.subject ? 'error' : ''"/>
                <FieldMessage v-if="form.errors.subject" status="error">{{ form.errors.subject }}</FieldMessage>

                <LabelText for="message" :status="form.errors.message ? 'error' : ''">Message</LabelText>
                <TextArea id="message" placeholder="Message" v-model="form.message" :status="form.errors.message ? 'error' : ''"/>
                <FieldMessage v-if="form.errors.message" status="error">{{ form.errors.message }}</FieldMessage>

                <PrimaryButton type="submit" :disabled="form.processing" class="block mx-auto mt-4">Send Message</PrimaryButton>
            </form>
        </DarkGlass>
    </MarginLayout>
    <Modal v-model:show="modal.show" :type="modal.type">
        <div class="flex-grow pb-2 overflow-x-auto" v-html="modal.message"></div>
        <div class="flex justify-end gap-2 pt-2 mt-1 border-t-2 border-gray-500">
            <SecondaryButton @click="modal.show=false">OK</SecondaryButton>
        </div>
    </Modal>
</template>
