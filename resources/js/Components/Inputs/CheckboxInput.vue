<script setup>
    const props = defineProps({
        modelValue: Boolean,
        id: String,
    });

    const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <label :for="id" class="inline-flex gap-1 my-2 text-sm select-none place-items-center">
        <input type="checkbox" :id="id" :checked="modelValue" @change="emit('update:modelValue', $event.target.checked)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-md accent-blue-600 focus:ring-blue-500 focus:ring-2"/>
        <span>
            <slot/>
        </span>
    </label>
</template>
