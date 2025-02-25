<script setup>
    const props = defineProps({
        status: {
            type: String,
            default: "normal",
        },
        modelValue: String,
    });

    const emit = defineEmits(["update:modelValue"]);

    const setStatusColor = () => {
        switch (props.status) {
            case "success":
            return "border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 focus:ring-green-500 focus:border-green-500 dark:border-green-500";
            case "error":
            return "border-red-500 text-red-900 dark:text-red-400 placeholder-red-700 dark:placeholder-red-500 focus:ring-red-500 focus:border-red-500 dark:border-red-500";
            case "warning":
            return "border-yellow-500 text-yellow-900 dark:text-yellow-400 placeholder-yellow-700 dark:placeholder-yellow-500 focus:ring-yellow-500 focus:border-yellow-500 dark:border-yellow-500";
            default:
            return "border-gray-500 text-gray-900 dark:text-gray-400 placeholder-gray-700 dark:placeholder-gray-500 focus:ring-gray-500 focus:border-gray-500 dark:border-gray-500";
        }
    };
</script>

<template>
    <input type="text" :value="modelValue" @input="emit('update:modelValue', $event.target.value)" class="block w-full p-2 mb-1 text-sm bg-white border rounded-lg dark:bg-gray-700" :class="setStatusColor()"/>
</template>
