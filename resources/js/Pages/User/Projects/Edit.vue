<script setup>
    import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton, LabelText, TextInput, RichTextEditorInput, VersionList, FieldMessage, CheckboxInput, ProjectPreviews, IconInput } from '@/Utils/MyComponents';
    import { ref } from 'vue';

    const props = defineProps({
        project: {
            type: Object,
            required: true,
        }
    });

    const APP_URL = import.meta.env.VITE_APP_URL;
    const STORAGE_PATH = `${APP_URL}/storage/`;
    const icon = STORAGE_PATH + props.project.icon_path;
    const previews = JSON.parse(props.project.previews).map((preview) => {
        return STORAGE_PATH + preview;
    });
    const downloadables = props.project.downloadables;

    const form = useForm({
        id: props.project.id,
        icon: null,
        title: props.project.name,
        previews: previews,
        about: props.project.about,
        summary: props.project.summary,
        description: props.project.description,
        downloadable: props.project.downloadable,
        downloadable_version: '',
        downloadable_file: null,
        downloadables: downloadables,
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

    const updateProject = () => {
        form.post(route('projects.update'), {
            onSuccess: () => showModalMessage(usePage().props.flash.success),
            onError: () => {
                if (form.errors.project){
                    showModalMessage(`Error: ${form.errors.project}`, { type: 'error' });
                }
            },
        });
    }
</script>

<template>
    <Head title="Add Project"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Edit <span class="text-green-500 ">Project</span></HeaderText>
        <div class="px-4">
            <div class="my-4">
                <Link :href="route('projects.manage')">
                    <PrimaryButton class="flex gap-2 place-items-center">
                        <font-awesome-icon :icon="['fas', 'angle-left']"/>
                        <span>Go Back</span>
                    </PrimaryButton>
                </Link>
            </div>
            <form @submit.prevent="updateProject">
                <div class="flex gap-2">
                    <IconInput v-model="form.icon" :defaultIcon="icon" :editable="true"/>
                    <div class="flex-grow">
                        <LabelText for="project-title">Project Title</LabelText>
                        <FieldMessage v-if="form.errors.title" status="error">{{ form.errors.title }}</FieldMessage>
                        <TextInput id="project-title" v-model="form.title" placeholder="Please enter project's title here..." class="w-full"/>
                        <div v-if="!downloadables.length" class="md:flex" :class="{'justify-between': form.downloadable, 'justify-end': !form.downloadable}">
                            <div v-if="form.downloadable" class="text-sm">
                                <div class="md:my-1">
                                    <label for="version" class="mr-1">Version:</label>
                                    <input id="version" type="text" v-model="form.downloadable_version" placeholder="v1.0.0" class="bg-transparent">
                                </div>
                                <PrimaryButton type="button" @click="openFileDialog" class="hidden gap-2 mt-2 mb-1 md:flex place-items-center">
                                    <font-awesome-icon :icon="['fas', 'upload']"/>
                                    <span>Upload File</span>
                                </PrimaryButton>
                            </div>
                            <div>
                                <CheckboxInput id="downloadable" v-model="form.downloadable">Downloadable</CheckboxInput>
                            </div>
                        </div>
                    </div>
                </div>
                <FieldMessage v-if="form.errors.icon" status="error">{{ form.errors.icon }}</FieldMessage>
                <div class="flex flex-col gap-2 my-2">
                    <div v-if="form.downloadable && !downloadables.length">
                        <input type="file" class="hidden" @change="downloadableFileUpload" ref="fileInputRef">
                        <div class="text-center" v-if="form.downloadable_file">
                            <div class="mb-3">
                                <span class="font-medium">File Name: </span>
                                <span v-text="uploadedFilenameRef"></span>
                            </div>
                        </div>
                        <FieldMessage v-if="form.errors.downloadable_version" class="text-center" status="error">{{ form.errors.downloadable_version }}</FieldMessage>
                        <FieldMessage v-if="form.errors.downloadable_file" class="text-center" status="error">{{ form.errors.downloadable_file }}</FieldMessage>
                        <PrimaryButton type="button" @click="openFileDialog" class="flex justify-center w-full gap-2 my-1 mb-1 md:hidden place-items-center">
                            <font-awesome-icon :icon="['fas', 'upload']"/>
                            <span>Upload File</span>
                        </PrimaryButton>
                    </div>
                    <div>
                        <LabelText for="previews">Previews</LabelText>
                        <ProjectPreviews v-model:previews="form.previews" :editable="true"/>
                    </div>
                    <div v-if="form.downloadables.length">
                        <LabelText>Versions</LabelText>
                        <VersionList v-model:versions="form.downloadables" :editable="true"/>
                    </div>
                    <div>
                        <LabelText for="about">About this project</LabelText>
                        <FieldMessage v-if="form.errors.about" status="error">{{ form.errors.about }}</FieldMessage>
                        <RichTextEditorInput id="about" v-model="form.about"/>
                    </div>
                    <div>
                        <LabelText for="summary">Summary</LabelText>
                        <FieldMessage v-if="form.errors.summary" status="error">{{ form.errors.summary }}</FieldMessage>
                        <RichTextEditorInput id="summary" v-model="form.summary"/>
                    </div>
                    <div>
                        <LabelText for="description">Description</LabelText>
                        <FieldMessage v-if="form.errors.description" status="error">{{ form.errors.description }}</FieldMessage>
                        <RichTextEditorInput id="description" v-model="form.description"/>
                    </div>
                </div>
                <hr>
                <div class="my-4">
                    <PrimaryButton type="submit" class="flex gap-2 place-items-center" :disabled="form.processing">
                        <font-awesome-icon :icon="['fas', 'save']"/>
                        <span>Save</span>
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </DarkGlass>
</template>