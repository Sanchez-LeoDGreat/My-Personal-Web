<script setup>
    import { ref, computed } from 'vue'

    const props = defineProps({
        modelValue: [File, Array],
        accept: { type: String, default: '' },
        multiple: { type: Boolean, default: false },
        id: { type: String, default: 'file-input' },
    })

    const emit = defineEmits(['update:modelValue'])

    const fileInput = ref(null)
    const isDragging = ref(false)

    const triggerInput = () => fileInput.value.click()

    const onFileChange = (e) => {
        const files = e.target.files
        emit('update:modelValue', props.multiple ? Array.from(files) : files[0])
    }

    const onDragOver = () => { isDragging.value = true }
    const onDragLeave = () => { isDragging.value = false }
    const onDrop = (e) => {
        isDragging.value = false
        const droppedFiles = e.dataTransfer.files
        emit('update:modelValue', props.multiple ? Array.from(droppedFiles) : droppedFiles[0])
    }

    const fileNames = computed(() => {
        if (Array.isArray(props.modelValue)) return props.modelValue.map(f => f.name)
        return props.modelValue ? [props.modelValue.name] : []
    });
</script>

<template>
    <div @dragover.prevent="onDragOver" @dragleave.prevent="onDragLeave" @drop.prevent="onDrop" @click="triggerInput" class="relative flex flex-col items-center justify-center p-6 transition duration-300 border-2 border-dashed cursor-pointer bg-slate-950 border-slate-700 rounded-xl hover:border-green-500" :class="{ 'border-green-500 bg-slate-900': isDragging }">
        <input :id="id" type="file" ref="fileInput" class="hidden" :accept="accept" :multiple="multiple" @change="onFileChange"/>

        <font-awesome-icon :icon="['fas', 'cloud-arrow-up']" class="mb-3 text-4xl text-green-500" />

        <p class="text-sm text-center text-white">
            Drop {{ multiple ? 'files' : 'a file' }} here or
            <span class="text-green-500 underline"> click to browse</span>
        </p>

        <ul v-if="fileNames.length" class="w-full mt-4 space-y-1 text-xs text-white">
            <li v-for="(name, index) in fileNames" :key="index" class="flex items-center gap-2 text-white/80">
                <font-awesome-icon :icon="['fas', 'file']" class="text-green-500" />
                {{ name }}
            </li>
        </ul>
    </div>
</template>
