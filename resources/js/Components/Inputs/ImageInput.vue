<script setup>
    import StaticAsset from '@/Utils/StaticAsset';
    import { ref, watch } from 'vue';

    const props = defineProps({
        modelValue: {
            type: [Object, String]
        },
        editable: {
            type: Boolean,
            default: false,
        },
        defaultImg: String
    });

    const emit = defineEmits(['update:modelValue']);

    const icon = ref(props.defaultImg || StaticAsset.img.projectDefaultIcon);
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
        } else {
            icon.value = props.defaultImg;
        }
    }

    watch(() => props.defaultImg, (val) => {
        icon.value = val;
    });
</script>

<template>
    <div class="relative" @mouseenter="if (editable) { uploadButton.show = true; }" @mouseleave="if (editable) { uploadButton.show = false; }">
        <img :src="icon" alt="Resume Image" class="object-cover bg-white rounded-md border-slate-800">
        <button v-show="uploadButton.show" @click="openFileDialog" type="button" class="absolute backdrop-blur-[1px] text-white inset-0 flex flex-col justify-center p-2 cursor-pointer bg-slate-950/70 place-items-center">
            <font-awesome-icon :icon="['fas', 'image']" class="text-4xl"/>
            <span class="text-xs font-bold">Upload Image</span>
        </button>
        <input type="file" @change="setIcon" ref="fileInputRef" accept="image/*" class="hidden">
    </div>
</template>