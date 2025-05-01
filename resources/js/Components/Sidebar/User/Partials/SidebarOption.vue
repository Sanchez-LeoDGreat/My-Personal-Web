<script setup>
    import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

    const props = defineProps({
        route: String,
        icon: Object,
        title: {
            type: String,
            required: true,
        },
        isActive: {
            type: Boolean,
            default: false
        },
        showSlot: {
            type: Boolean,
            default: false,
        },
        isDropDown: {
            type: Boolean,
            default: false
        },
        isDropDownOption: {
            type: Boolean,
            default: false,
        }
    });

    const dropDown = ref({
        show: false,
    });
</script>

<template>
    <li v-if="isDropDown" @click="dropDown.show=!dropDown.show" class="flex flex-col w-full cursor-pointer">
        <div class="flex flex-grow place-items-center">
            <div class="flex flex-grow gap-2 hover:text-black hover:bg-white place-items-center">
                <div class="flex justify-center w-11">
                    <font-awesome-icon :icon="icon" class="p-1 ml-3 w-full text-2xl rounded-md" :class="{'active': isActive}"/>
                </div>
                <div v-show="showSlot" class="flex-grow font-medium" :class="{'underline' : isActive}" v-text="title"></div>
            </div>
        </div>
        <ul v-if="showSlot" class="font-medium flex my-1 gap-1 flex-col w-full overflow-hidden transition-all" :class="{'max-h-0': !dropDown.show, 'max-h-screen': dropDown.show}">
            <slot/>
        </ul>
    </li>
    <Link v-else :href="route" class="text-white w-full">
        <li class="flex w-full">
            <div class="flex flex-grow place-items-center">
                <div class="flex flex-grow gap-2 hover:text-black hover:bg-white place-items-center">
                    <div v-if="isDropDownOption" class="pl-6">
                        <font-awesome-icon :icon="['fas', 'angle-right']"/>
                    </div>
                    <div class="flex justify-center w-11">
                        <font-awesome-icon :icon="icon" class="p-1 ml-3 w-full text-xl rounded-md" :class="{'active': isActive}"/>
                    </div>
                    <div v-show="showSlot" class="flex-grow font-medium" :class="{'underline' : isActive}" v-text="title"></div>
                </div>
            </div>
        </li>
    </Link>
</template>

<style scoped>
    .active{
        @apply bg-white text-black
    }
</style>
