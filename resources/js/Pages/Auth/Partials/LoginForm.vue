<script setup>
    import HeaderText from "@/Components/Texts/HeaderText.vue";
    import LabelText from "@/Components/Texts/LabelText.vue";
    import TextInput from "@/Components/Inputs/TextInput.vue";
    import PasswordInput from "@/Components/Inputs/PasswordInput.vue";
    import CheckboxInput from "@/Components/Inputs/CheckboxInput.vue";
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
    import FieldMessage from "@/Components/Texts/FieldMessage.vue";
    import AuthForm from "@/Pages/Auth/Partials/AuthForm.vue";
    import { useForm, Link } from "@inertiajs/vue3";

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const login = () => {
        form.post(route('login.validate'), {
            onError: () => form.reset('password'),
        });
    }
</script>

<template>
    <AuthForm @submit.prevent="login" class="px-6 py-2 border-2 border-white rounded-lg min-w-[30vw] mx-10 bg-slate-950/70 backdrop-blur-md">
        <HeaderText class="text-center">Login</HeaderText>
        <div class="my-2">
            <LabelText for="email" class="block" :status="form.errors.email ? 'error' : ''">Email:</LabelText>
            <TextInput type="email" id="email" placeholder="Email" v-model="form.email" :status="form.errors.email ? 'error' : ''"/>
            <FieldMessage v-if="form.errors.email" status="error">{{ form.errors.email }}</FieldMessage>

            <LabelText for="password" :status="form.errors.password ? 'error' : ''">Password:</LabelText>
            <PasswordInput id="password" placeholder="Password" v-model="form.password" :status="form.errors.password ? 'error' : ''"/>
            <FieldMessage v-if="form.errors.password" status="error">{{ form.errors.password }}</FieldMessage>
            <FieldMessage v-if="form.errors.login" status="error">{{ form.errors.login }}</FieldMessage>

            <label for="remember" class="flex gap-1 my-2 text-sm select-none place-items-center">
                <CheckboxInput id="remember" v-model="form.remember"/>
                <span>Remember Me</span>
            </label>

            <PrimaryButton type="submit" class="w-full" :disabled="form.processing">Login</PrimaryButton>

            <Link href="" class="mt-1 text-blue-500 underline float-end">Forgot Password?</Link>
        </div>
    </AuthForm>
</template>
