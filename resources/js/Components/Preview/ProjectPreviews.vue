<script setup>
    import { PrimaryButton } from '@/Utils/MyComponents';
    import { getFileType } from '@/Utils/StringUtils';

    const props = defineProps({
        previews: {
            type: Array,
        },
        editable: {
            type: Boolean,
            default: false
        },
    });

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*,video/*';
    fileInput.multiple = true;

    $(fileInput).on('change', () => {
        const files = Array.from(fileInput.files);
        const validFiles = files.filter(file => file.type.startsWith('image/') || file.type.startsWith('video/'));

        validFiles.forEach((file) => {
            if (!props.previews.includes(file)){
                props.previews.push(file);
            }
        });
    });

    const displayFile = (file) => {
        if (typeof file == "object"){
            return URL.createObjectURL(file);
        }
        return file;
    }

    const removePreview = (index) => {
        props.previews.splice(index, 1);
    }

    const addPreviews = () => {
        fileInput.click();
    }

    const dragStart = (e, index) => {
        if (props.editable){
            e.dataTransfer.setData('dragged-preview-index', index);
        }
    }

    const allowDrop = (e) => {
        if (props.editable){
            e.preventDefault();
        }
    }

    const getPreviewFileType = (file) => {
        if (typeof file == "object"){
            if (file.type.startsWith('image/')){
                return 'image';
            } else if (file.type.startsWith('video/')) {
                return 'video';
            }
        } else if (typeof file == "string"){
            return getFileType(file);
        } else {
            throw new Error("Invalid file type");
        }
    }

    const switchData = (e, index) => {
        if (props.editable){
            const draggedIndex = e.dataTransfer.getData('dragged-preview-index');
            const droppedIndex = index;

            const temp = [...props.previews];

            props.previews[draggedIndex] = temp[droppedIndex];
            props.previews[droppedIndex] = temp[draggedIndex];
        }
    }
</script>

<template>
    <div>
        <div class="flex flex-col min-h-48">
            <div v-if="previews.length">
                <div class="flex gap-2 py-2 overflow-x-auto scrollbar-hide">
                    <div v-for="(preview, index) in previews" :key="index">
                        <div class="relative cursor-grab" :draggable="editable" @dragstart="dragStart($event, index)" @drop="switchData($event, index)" @dragover="allowDrop">
                            <img v-if="getPreviewFileType(preview) === 'image'" :src="displayFile(preview)" alt="Preview Image" class="max-h-48 h-48 min-w-72 object-cover md:max-w-[30vw] rounded-md">
                            <video v-else-if="getPreviewFileType(preview) === 'video'" :src="displayFile(preview)" controls class="max-h-48 h-48 min-w-72 md:max-w-[30vw] bg-slate-950/50 rounded-md"></video>
                            <button type="button" @click="removePreview(index)" class="absolute top-0 right-0 px-2 py-1 text-red-500 cursor-pointer hover:text-red-800 bg-black/20">
                                <font-awesome-icon :icon="['fas', 'trash']"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="flex justify-center flex-grow place-items-center">
                <p>No previews available.</p>
            </div>
        </div>
        <div class="py-2">
            <PrimaryButton type="button" @click="addPreviews" class="flex gap-2 place-items-center">
                <font-awesome-icon :icon="['fas', 'add']"/>
                <span>Add Preview/s</span>
            </PrimaryButton>
        </div>
    </div>
</template>