<script setup>
    const props = defineProps({
        status: {
            type: String,
            default: 'normal',
        }
    });

    const setStatusColor = () => {
        switch (props.status) {
            case "success":
                return "text-green-700 dark:text-green-500";
            case "error":
                return "text-red-700 dark:text-red-500";
            case "warning":
                return "text-yellow-700 dark:text-yellow-500";
            default:
                return "";
        }
    };
</script>

<template>
    <div class="mb-1 text-sm font-medium" :class="setStatusColor()">
        <slot/>
    </div>
</template>
