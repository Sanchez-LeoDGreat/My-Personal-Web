<script setup>
    import { Head, useForm } from '@inertiajs/vue3';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { FieldMessage, LabelText, TextInput, PrimaryButton, TextAreaInput, HeaderText, DarkGlass } from '@/Utils/MyComponents';
    import { nextTick, ref } from 'vue';

    const form = useForm({
        full_name: null,
        email: null,
        phone_number: null,
        subject: null,
        message: null
    });

    const send = () => {
        form.post(route('contact.send-email'),  {
            onSuccess: async () => {
                await nextTick();
                showModalMessage("Email has been sent successfully");
                form.reset();
            },
            onError: async () => {
                if (form.errors.failed){
                    await nextTick();
                    showModalMessage(form.errors.failed, 'error');
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
                <TextAreaInput id="message" placeholder="Message" v-model="form.message" :status="form.errors.message ? 'error' : ''"/>
                <FieldMessage v-if="form.errors.message" status="error">{{ form.errors.message }}</FieldMessage>

                <PrimaryButton type="submit" :disabled="form.processing" class="block mx-auto mt-4">Send Message</PrimaryButton>
            </form>
        </DarkGlass>
    </MarginLayout>
</template>
