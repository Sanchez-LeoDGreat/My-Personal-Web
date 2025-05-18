<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  modelValue: File || Array,
  label: { type: String, default: 'Upload File' },
  accept: { type: String, default: '' }, // e.g. "image/*"
  multiple: { type: Boolean, default: false },
  id: { type: String, default: () => `file-input-${Math.random().toString(36).slice(2, 8)}` },
})

const emit = defineEmits(['update:modelValue'])

const handleChange = (e) => {
  const files = e.target.files
  if (props.multiple) {
    emit('update:modelValue', Array.from(files))
  } else {
    emit('update:modelValue', files[0] || null)
  }
}

const selectedFileNames = computed(() => {
  if (Array.isArray(props.modelValue)) {
    return props.modelValue.map(f => f.name)
  }
  return props.modelValue ? [props.modelValue.name] : []
})
</script>

<style scoped>
.file-input {
  @apply border p-2 rounded text-sm;
}
</style>

<template>
    <div class="flex flex-col gap-2">
        <label :for="id" class="text-sm font-medium text-gray-700">
            {{ label }}
        </label>

        <input
            :id="id"
            type="file"
            :accept="accept"
            :multiple="multiple"
            @change="handleChange"
            class="w-full max-w-sm file-input file-input-bordered"
        />

        <div v-if="selectedFileNames.length" class="text-xs text-gray-500">
            Selected: {{ selectedFileNames.join(', ') }}
        </div>
    </div>
</template>

