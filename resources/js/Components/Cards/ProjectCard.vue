<script setup>
    import { PrimaryButton } from '@/Utils/MyComponents';
    import { getFileType } from '@/Utils/StringUtils';
    import { onMounted, ref } from 'vue';
    import StaticAsset from '@/Utils/StaticAsset';
    import { router } from '@inertiajs/vue3';
    import { STORAGE_PATH } from '@/Utils/AppUtils';
    import { calculateRatings } from '@/Utils/AppUtils';

    const props = defineProps({
        project: {
            type: Object,
            required: true
        },
        editable: {
            type: Boolean,
            default: false,
        },
        onDelete: Function,
        isDeleting: {
            type: Boolean,
            default: false,
        }
    });
    const iconPath = STORAGE_PATH + props.project.icon_path;
    const previews = JSON.parse(props.project.previews);
    const firstPreview = previews.length ? STORAGE_PATH + previews[0] : StaticAsset.img.bg1;
    const latestVersion = props.project.downloadables[0]?.version;
    const rate = ref(0);
    const ratings = props.project.reviews.map((review) => review.rating);

    const goToProject = (id) => {
        if (props.editable){
            router.visit(route('projects.edit', id));
        } else {
            router.visit(route('projects.view', id));
        }
    }

    const handleDelete = async () => {
        if (typeof props.onDelete == 'function'){
            props.onDelete();
        } else {
            throw new Error('Invalid type of function!');
        }
    }

    const downloadProject = (id) => {
        //TODO: Add download project logic here
    }

    onMounted(() => {
        rate.value = calculateRatings(ratings);
    });
</script>

<template>
    <div class="relative overflow-hidden border-2 border-transparent rounded-md hover:border-green-500">
        <div class="relative">
            <img v-if="getFileType(firstPreview) == 'image'" @click="goToProject(project.id)" :src="firstPreview" alt="Project Preview" class="object-cover w-full h-48 cursor-pointer">
            <video v-else-if="getFileType(firstPreview) == 'video'" :src="firstPreview" controls class="w-full h-48 bg-slate-950/40 backdrop-blur-md"></video>
            <button @click="handleDelete" class="absolute top-0 right-0 px-2 py-1 text-red-500 bg-slate-950/50 hover:text-red-800">
                <font-awesome-icon :icon="['fas', 'trash']"/>
            </button>
        </div>
        <div class="flex p-2 bg-slate-950" :class="{'justify-between': project.downloadable, 'justify-start': !project.downloadable}">
            <div @click="goToProject(project.id)" class="flex cursor-pointer">
                <img :src="iconPath" alt="Project Icon" class="object-cover w-16 h-16 rounded-md min-w-16 min-h-16">
            </div>
            <div @click="goToProject(project.id)" class="flex w-full min-w-0 px-2 cursor-pointer">
                <div class="flex flex-col min-w-0">
                    <div v-text="project.name" class="text-lg font-medium truncate"></div>
                    <div class="flex gap-1 text-xs place-items-center">
                        <span v-text="rate.toFixed(1)"></span>
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
        <div v-if="isDeleting" class="absolute inset-0 flex justify-center bg-slate-950/50 place-items-center">
            <div class="flex gap-2 place-items-center">
                <span>
                    <font-awesome-icon :icon="['fas', 'spinner']" class="text-3xl animate-spin"/>
                </span>
                <span class="font-medium animate-pulse">Deleting...</span>
            </div>
        </div>
    </div>
</template>