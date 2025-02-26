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
            return "border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500";
            case "error":
            return "border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500";
            case "warning":
            return "border-yellow-500 text-yellow-900 placeholder-yellow-700 focus:ring-yellow-500 focus:border-yellow-500";
            default:
            return "border-gray-500 text-gray-900 placeholder-gray-700 focus:ring-gray-500 focus:border-gray-500";
        }
    };
</script>

<template>
    <input type="text" :value="modelValue" @input="emit('update:modelValue', $event.target.value)" class="block w-full p-2 mb-1 text-sm bg-white border rounded-lg" :class="setStatusColor()"/>
</template>
