<script setup>
    import AuthForm from "@/Pages/Auth/Partials/AuthForm.vue";
    import { useForm, Link } from "@inertiajs/vue3";
    import { HeaderText, LabelText, TextInput, PasswordInput, CheckboxInput, PrimaryButton, FieldMessage } from "@/Utils/MyComponents";

    const form = useForm({
        email: null,
        password: null,
        remember: false,
    });

    const login = () => {
        form.post(route('login'), {
            onError: () => form.reset('password'),
        });
    }
</script>

<template>
    <AuthForm @submit.prevent="login">
        <HeaderText class="text-center">Login</HeaderText>
        <div class="my-2">
            <LabelText for="email" :status="form.errors.email ? 'error' : ''">Email:</LabelText>
            <TextInput type="email" id="email" placeholder="Email" v-model="form.email" :status="form.errors.email ? 'error' : ''"/>
            <FieldMessage v-if="form.errors.email" status="error">{{ form.errors.email }}</FieldMessage>

            <LabelText for="password" :status="form.errors.password ? 'error' : ''">Password:</LabelText>
            <PasswordInput id="password" placeholder="Password" v-model="form.password" :status="form.errors.password ? 'error' : ''"/>
            <FieldMessage v-if="form.errors.password" status="error">{{ form.errors.password }}</FieldMessage>
            <FieldMessage v-if="form.errors.login" status="error">{{ form.errors.login }}</FieldMessage>

            <CheckboxInput id="remember" v-model="form.remember">Remember Me</CheckboxInput>

            <PrimaryButton type="submit" class="w-full" :disabled="form.processing">Login</PrimaryButton>

            <Link href="" class="mt-1 text-blue-500 underline float-end">Forgot Password?</Link>
        </div>
    </AuthForm>
</template>
