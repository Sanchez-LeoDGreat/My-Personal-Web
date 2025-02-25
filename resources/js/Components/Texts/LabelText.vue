<script setup>
    const props = defineProps({
        status: {
            type: String,
            default: "normal",
        },
    });

const setStatusColor = () => {
    switch (props.status) {
        case "success":
        return "text-green-600";
        case "error":
        return "text-red-600";
        case "warning":
        return "text-yellow-600";
        default:
        return "";
    }
};
</script>

<template>
    <label for="" class="block mb-1 font-medium" :class="setStatusColor()">
        <slot />
    </label>
</template>
