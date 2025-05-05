<script setup>
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton, LabelText, TextInput, RichTextEditorInput, FieldMessage, CheckboxInput, ProjectPreviews, IconInput } from '@/Utils/MyComponents';
    import { ref } from 'vue';

    const form = useForm({
        icon: null,
        title: null,
        previews: [],
        about: null,
        summary: null,
        description: null,
        downloadable: false,
        downloadable_version: '',
        downloadable_file: null,
    });

    const fileInputRef = ref(null);
    const uploadedFilenameRef = ref(null);

    const openFileDialog = () => {
        fileInputRef.value.click();
    }

    const downloadableFileUpload = () => {
        const file = fileInputRef.value.files[0];
        if (file) {
            form.downloadable_file = file;
            uploadedFilenameRef.value = file.name;
        }
    }

    const addProject = () => {
        form.post(route('projects.store'), {
            forceFormData: true,
            onSuccess: () => {
                showModalMessage(usePage().props.flash.success);
            },
        });
    }
</script>

<template>
    <Head title="Add Project"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Add <span class="text-green-500 ">Project</span></HeaderText>
        <div class="px-4">
            <div class="my-4">
                <Link :href="route('projects.manage')">
                    <PrimaryButton class="flex gap-2 place-items-center">
                        <font-awesome-icon :icon="['fas', 'angle-left']"/>
                        <span>Go Back</span>
                    </PrimaryButton>
                </Link>
            </div>
            <form @submit.prevent="addProject">
                <div class="flex gap-2">
                    <IconInput v-model="form.icon" :editable="true"/>
                    <div class="flex-grow">
                        <LabelText for="project-title">Project Title</LabelText>
                        <FieldMessage v-if="form.errors.title" status="error">{{ form.errors.title }}</FieldMessage>
                        <TextInput id="project-title" v-model="form.title" placeholder="Please enter project's title here..."/>
                        <CheckboxInput id="downloadable" class="float-end" v-model="form.downloadable">Downloadable</CheckboxInput>
                    </div>
                </div>
                <FieldMessage v-if="form.errors.icon" status="error">{{ form.errors.icon }}</FieldMessage>
                <div class="flex flex-col gap-2 my-2">
                    <div v-if="form.downloadable">
                        <LabelText for="version">Version</LabelText>
                        <FieldMessage v-if="form.errors.downloadable_version" status="error">{{ form.errors.downloadable_version }}</FieldMessage>
                        <div class="flex gap-2 place-items-center">
                            <div class="flex-grow">
                                <TextInput id="version" v-model="form.downloadable_version" placeholder="v1.0.0"/>
                            </div>
                            <div>
                                <PrimaryButton type="button" @click="openFileDialog" class="flex gap-2 mb-1 place-items-center">
                                    <font-awesome-icon :icon="['fas', 'upload']"/>
                                    <span>Upload File</span>
                                </PrimaryButton>
                                <input type="file" class="hidden" @change="downloadableFileUpload" ref="fileInputRef">
                            </div>
                        </div>
                        <div class="text-center" v-if="form.downloadable_file">
                            <div>
                                <span class="font-medium">File Name: </span>
                                <span v-text="uploadedFilenameRef"></span>
                            </div>
                        </div>
                        <FieldMessage v-if="form.errors.downloadable_file" class="text-center" status="error">{{ form.errors.downloadable_file }}</FieldMessage>
                    </div>
                    <div>
                        <LabelText for="previews">Previews</LabelText>
                        <ProjectPreviews v-model:previews="form.previews" :editable="true"/>
                    </div>
                    <div>
                        <LabelText for="about">About this project</LabelText>
                        <FieldMessage v-if="form.errors.about" status="error">{{ form.errors.about }}</FieldMessage>
                        <RichTextEditorInput id="about"/>
                    </div>
                    <div>
                        <LabelText for="summary">Summary</LabelText>
                        <FieldMessage v-if="form.errors.summary" status="error">{{ form.errors.summary }}</FieldMessage>
                        <RichTextEditorInput id="summary"/>
                    </div>
                    <div>
                        <LabelText for="description">Description</LabelText>
                        <FieldMessage v-if="form.errors.description" status="error">{{ form.errors.description }}</FieldMessage>
                        <RichTextEditorInput id="description"/>
                    </div>
                </div>
                <hr>
                <div class="my-4">
                    <PrimaryButton type="submit" class="flex gap-2 place-items-center" :disabled="form.processing">
                        <font-awesome-icon :icon="['fas', 'add']"/>
                        <span>Add Project</span>
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </DarkGlass>
</template>