<script setup>
    const props = defineProps({
        id: String,
        placeholder: String,
        modelValue: String,
    });

    const emit = defineEmits(["update:modelValue", "input"]);

    const handleInput = (e) => {
        emit('update:modelValue', e.target.value);
        emit('input', e);
    }
</script>

<template>
    <div class="mx-0.5">
        <div class="flex w-full mb-1 overflow-hidden text-black bg-white rounded-[5px] ring-1 ring-offset-2 focus-within:ring-white focus-within:ring-offset-black">
            <div class="flex-grow overflow-hidden">
                <input :id="id" :value="modelValue" @input="handleInput" :placeholder="placeholder" type="text" class="px-2 w-full py-1.5 text-sm border-0 outline-none">
            </div>
            <button type="button" class="pl-2 pr-[5px] border-[1px] border-l-gray-800">
                <font-awesome-icon :icon="['fas', 'magnifying-glass']" class="w-5"/>
            </button>
        </div>
    </div>
</template>
