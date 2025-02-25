<script setup>
    const props = defineProps({
        modelValue: Boolean,
    });

    const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <input type="checkbox"  :checked="modelValue" @change="emit('update:modelValue', $event.target.checked)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-md accent-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
</template>
