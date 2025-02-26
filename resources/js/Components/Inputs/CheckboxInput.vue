<script setup>
    const props = defineProps({
        modelValue: Boolean,
    });

    const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <input type="checkbox"  :checked="modelValue" @change="emit('update:modelValue', $event.target.checked)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-md accent-blue-600 focus:ring-blue-500 focus:ring-2"/>
</template>
