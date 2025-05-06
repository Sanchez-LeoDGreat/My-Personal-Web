<script setup>
    import { PrimaryButton } from '@/Utils/MyComponents';
    import { getFileType } from '@/Utils/StringUtils';
    import { onMounted, ref } from 'vue';
    import StaticAsset from '@/Utils/StaticAsset';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        project: {
            type: Object,
            required: true
        },
        editable: {
            type: Boolean,
            default: false,
        }
    });
    const APP_URL = import.meta.env.VITE_APP_URL;
    const STORAGE_PATH = `${APP_URL}/storage/`
    const iconPath = STORAGE_PATH + props.project.icon_path;
    const previews = JSON.parse(props.project.previews);
    const firstPreview = previews.length ? STORAGE_PATH + previews[0] : StaticAsset.img.bg1;
    const latestVersion = props.project.downloadables[0]?.version;
    const ratings = ref(0);

    const calculateRatings = () => {
        const reviews = props.project.reviews;
        if (!reviews.length) ratings.value = 0;
        ratings.value = reviews.reduce((acc, review) => acc + review.rating, 0);
    }

    const goToProject = (id) => {
        if (props.editable){
            router.visit(route('projects.edit', id));
        } else {
            router.visit(route('projects.view', id));
        }
    }

    const downloadProject = (id) => {
        //TODO: Add download project logic here
    }

    const deleteProject = (id) => {
        showConfirmationModal('Are you sure you want to delete this project?', {
            type: 'warning',
            onYes: () => {
                //TODO: Add delete project logic here
                showModalMessage('Project removed successfully!');
            }
        });
    }

    onMounted(() => {
        calculateRatings();
    });
</script>

<template>
    <div class="overflow-hidden border-2 border-transparent rounded-md hover:border-green-500">
        <div class="relative">
            <img v-if="getFileType(firstPreview) == 'image'" @click="goToProject(project.id)" :src="firstPreview" alt="Project Preview" class="object-cover cursor-pointer w-full h-48">
            <video v-else-if="getFileType(firstPreview) == 'video'" :src="firstPreview" controls class="w-full h-48 bg-slate-950/40 backdrop-blur-md"></video>
            <button @click="deleteProject(project.id)" class="absolute top-0 right-0 bg-slate-950/50 px-2 py-1 text-red-500 hover:text-red-800">
                <font-awesome-icon :icon="['fas', 'trash']"/>
            </button>
        </div>
        <div class="flex gap-4 p-2 bg-slate-950" :class="{'justify-between': project.downloadable, 'justify-start': !project.downloadable}">
            <div @click="goToProject(project.id)" class="flex cursor-pointer">
                <img :src="iconPath" alt="Project Icon" class="object-cover w-16 h-16 rounded-md min-w-16 min-h-16">
            </div>
            <div @click="goToProject(project.id)" class="flex min-w-0 gap-2 cursor-pointer">
                <div class="flex flex-col min-w-0">
                    <div v-text="project.name" class="text-lg font-medium truncate"></div>
                    <div class="flex gap-1 text-xs place-items-center">
                        <span v-text="ratings.toFixed(1)"></span>
                        <font-awesome-icon :icon="['fas', 'star']"/>
                    </div>
                </div>
            </div>
            <div v-if="project.downloadable" class="flex flex-col shrink-0">
                <PrimaryButton @click="downloadProject(project.id)" class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fas', 'download']"/>
                    <span>Download</span>
                </PrimaryButton>
                <div class="my-1 text-xs text-center" v-text="latestVersion"></div>
            </div>
        </div>
    </div>
</template>