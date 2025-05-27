<script setup>
    const props = defineProps({
        modelValue: String,
        status: {
            type: String,
            default: "normal",
        },
        options: {
            type: Array,
            required: true,
        },
        id: String,
        hasBlank: {
            type: Boolean,
            default: false
        },
    });

    const emit = defineEmits(['update:modelValue', 'change']);

    const handleChange = (e) => {
        emit('update:modelValue', e.target.value);
        emit('change', e);
    }

    const setStatusColor = () => {
        switch (props.status) {
            case "success":
                return "border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500";
            case "error":
                return "border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500";
            case "warning":
                return "border-yellow-500 text-yellow-900 placeholder-yellow-700 focus:ring-yellow-500";
            default:
                return "border-gray-500 text-gray-900 placeholder-gray-700 focus:ring-gray-500";
        }
    };
</script>

<template>
    <select :id="id" @change="handleChange" class="block w-full p-2 mb-1 text-sm text-black bg-white border rounded-lg">
        <option v-if="hasBlank" value=""></option>
        <option v-for="(option, index) in options" :key="index" :value="option.value" :selected="modelValue == option.value">{{ option.text }}</option>
    </select>
</template>