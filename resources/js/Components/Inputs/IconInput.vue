<script setup>
    import StaticAsset from '@/Utils/StaticAsset';
    import { ref } from 'vue';

    const props = defineProps({
        modelValue: {
            type: Object
        },
        editable: {
            type: Boolean,
            default: false,
        },
        defaultIcon: String
    });

    const emit = defineEmits(['update:modelValue']);

    const icon = ref(props.defaultIcon || StaticAsset.img.projectDefaultIcon);
    const uploadButton = ref({
        show: false,
    });
    const fileInputRef = ref(null);

    const openFileDialog = () => {
        fileInputRef.value.click();
    }

    const setIcon = () => {
        const file = fileInputRef.value.files[0];
        if (file) {
            if (!file.type.startsWith('image/')){
                showModalMessage('File type must be an image!', { type: 'error' });
                return;
            }
            icon.value = URL.createObjectURL(file);
            emit('update:modelValue', file);
        }
    }
</script>

<template>
    <div class="relative" @mouseenter="if (editable) { uploadButton.show = true; }" @mouseleave="if (editable) { uploadButton.show = false; }">
        <img :src="icon" alt="Project Icon" class="object-cover bg-white border-2 rounded-md border-slate-800 w-28 h-28 max-w-28 max-h-28">
        <button v-show="uploadButton.show" @click="openFileDialog" type="button" class="absolute backdrop-blur-[1px] inset-0 flex flex-col justify-center p-2 cursor-pointer bg-slate-950/70 place-items-center">
            <font-awesome-icon :icon="['fas', 'image']" class="text-4xl"/>
            <span class="text-xs font-bold">Upload Image</span>
        </button>
        <input type="file" @change="setIcon" ref="fileInputRef" accept="image/*" class="hidden">
    </div>
</template>