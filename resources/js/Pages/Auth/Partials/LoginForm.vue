<script setup>
    import HeaderText from "@/Components/Texts/HeaderText.vue";
    import LabelText from "@/Components/Texts/LabelText.vue";
    import TextInput from "@/Components/Inputs/TextInput.vue";
    import CheckboxInput from "@/Components/Inputs/CheckboxInput.vue";
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
    import FieldMessage from "@/Components/Texts/FieldMessage.vue";
    import { useForm } from "@inertiajs/vue3";
    import PasswordInput from "@/Components/Inputs/PasswordInput.vue";

    const form = useForm({
        email: null,
        password: null,
        remember: false,
    });
</script>

<template>
    <form @submit.prevent="" class="px-6 py-2 border-2 border-white rounded-lg min-w-[30vw] mx-10">
        <HeaderText class="text-center">Login</HeaderText>
        <div class="my-2">
            <LabelText for="email" class="block">Email:</LabelText>
            <TextInput type="email" id="email" placeholder="Email" v-model="form.email"/>
            <FieldMessage v-if="form.errors.email" status="error">{{ form.errors.email }}</FieldMessage>

            <LabelText for="password">Password:</LabelText>
            <PasswordInput id="password" placeholder="Password" v-model="form.password" />
            <FieldMessage v-if="form.errors.password" status="error">{{ form.errors.password }}</FieldMessage>

            <label for="remember" class="flex gap-1 my-2 text-sm select-none place-items-center">
                <CheckboxInput id="remember"/>
                <span>Remember Me</span>
            </label>

            <PrimaryButton type="submit" class="w-full" :disabled="form.processing">Login</PrimaryButton>
        </div>
    </form>
</template>
