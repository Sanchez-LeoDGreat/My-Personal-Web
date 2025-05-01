<script setup>
    import { HeaderText, Loading } from '@/Utils/MyComponents';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import RichTextEditorInput from '@/Components/Inputs/RichTextEditorInput.vue';

    const form = useForm({
        introduction: '',
    });
</script>

<template>
    <MarginLayout>
        <HeaderText class="mb-1">Home <span class="text-green-500 ">Page</span></HeaderText>
        <div class="px-2">
            <form @submit.prevent>
                <HeaderText class="mb-1">Skills</HeaderText>
                <HeaderText class="mb-1">Introduction</HeaderText>
                <RichTextEditorInput v-model="form.introduction"/>
            </form>
        </div>
    </MarginLayout>
</template>