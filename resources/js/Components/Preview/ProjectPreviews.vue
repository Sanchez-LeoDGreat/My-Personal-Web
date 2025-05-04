<script setup>
    import { PrimaryButton } from '@/Utils/MyComponents';

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
            console.log(props.previews);
        });
    });

    const displayFile = (file) => {
        return URL.createObjectURL(file);
    }

    const removePreview = (index) => {
        props.previews.splice(index, 1);
    }

    const addPreviews = () => {
        fileInput.click();
    }
</script>

<template>
    <div>
        <div class="flex flex-col min-h-48 max-h-48">
            <div v-if="previews.length > 0">
                <div class="flex gap-2 overflow-x-auto">
                    <div v-for="(preview, index) in previews" :key="index" class="relative">
                        <img v-if="preview.type.startsWith('image/')" :src="displayFile(preview)" alt="Preview Image" class="max-h-48 object-contain max-w-[30vw] rounded-md">
                        <video v-else-if="preview.type.startsWith('video/')" :src="displayFile(preview)" controls class="max-h-48 max-w-[30vw] rounded-md"></video>
                        <button @click="removePreview(index)" class="absolute top-0 right-0 px-2 py-1 text-red-500 hover:text-red-800 bg-black/20">
                            <font-awesome-icon :icon="['fas', 'trash']"/>
                        </button>
                    </div>
                </div>
            </div>
            <div v-else class="flex justify-center flex-grow place-items-center">
                <p>No previews available.</p>
            </div>
        </div>
        <div class="my-4">
            <PrimaryButton type="button" @click="addPreviews" class="flex gap-2 place-items-center">
                <font-awesome-icon :icon="['fas', 'add']"/>
                <span>Add Preview</span>
            </PrimaryButton>
        </div>
    </div>
</template>