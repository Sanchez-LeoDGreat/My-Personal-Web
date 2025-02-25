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
    <div class="my-1 text-sm font-medium" :class="setStatusColor()">
        <slot/>
    </div>
</template>
