<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        status: {
            type: String,
            default: 'normal',
        },
        id: String,
        placeholder: String,
        modelValue: String,
    });

    const show = ref(false);
    const passwordInput = ref(null);
    const emit = defineEmits(["update:modelValue"]);

    const setColorStatusContainer = () => {
        switch(props.status){
            case 'success':
                return 'ring-green-500';
            case 'error':
                return 'ring-red-500';
            case 'warning':
                return 'ring-yellow-500';
            default:
                return 'ring-gray-500';
        }
    }

    const setStatusColorInput = () => {
        switch(props.status){
            case 'success':
                return 'text-green-900 placeholder-green-700';
            case 'error':
                return 'text-red-900 placeholder-red-700';
            case 'warning':
                return 'text-yellow-900 placeholder-yellow-700';
            default:
                return 'text-gray-900 placeholder-gray-700';
        }
    }

    const setStatusColorIcon = () => {
        switch(props.status){
            case 'success':
                return 'text-green-500';
            case 'error':
                return 'text-red-500';
            case 'warning':
                return 'text-yellow-500';
            default:
                return 'text-blue-700';
        }
    }

    const toggleShowPass = () => {
        show.value = !show.value;
    }
</script>

<template>
    <div class="mx-0.5">
        <div class="flex w-full mb-1 overflow-hidden bg-white rounded-[5px] ring-1 ring-offset-2 focus-within:ring-white focus-within:ring-offset-black" :class="setColorStatusContainer()">
            <div class="flex-grow overflow-hidden">
                <input :id="id" :value="modelValue" @input="emit('update:modelValue', $event.target.value)" :placeholder="placeholder" :type="show ? 'text' : 'password'" ref="passwordInput" class="px-2 w-full py-1.5 text-sm border-0 outline-none" :class="setStatusColorInput()">
            </div>
            <button type="button" @click="toggleShowPass" class="pl-2 pr-[5px] border-[1px] border-l-gray-800" :class="setStatusColorIcon()">
                <FontAwesomeIcon :icon="show ? ['fas', 'eye-slash'] : ['fas', 'eye']" class="w-5"/>
            </button>
        </div>
    </div>
</template>
