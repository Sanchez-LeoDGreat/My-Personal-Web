<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton, LabelText, TextInput, RichTextEditorInput, FieldMessage, CheckboxInput, ProjectPreviews, IconInput } from '@/Utils/MyComponents';
    import { ref } from 'vue';
    import StaticAsset from '@/Utils/StaticAsset';

    const form = useForm({
        icon: null,
        title: null,
        previews: [],
        about: null,
        summary: null,
        description: null,
        downloadable: false,
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
        console.log(form.icon);
    }
</script>

<template>
    <Head title="Projects"/>
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
                        <TextInput id="project-title" placeholder="Please enter project's title here..."/>
                        <CheckboxInput id="downloadable" class="float-end" v-model="form.downloadable">Downloadable</CheckboxInput>
                    </div>
                </div>
                <div class="flex flex-col gap-2 my-2">
                    <div v-if="form.downloadable">
                        <LabelText for="version">Version</LabelText>
                        <div class="flex gap-2 place-items-center">
                            <div class="flex-grow">
                                <TextInput id="version" placeholder="v1.0.0"/>
                            </div>
                            <div>
                                <PrimaryButton @click="openFileDialog" class="flex gap-2 mb-1 place-items-center">
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