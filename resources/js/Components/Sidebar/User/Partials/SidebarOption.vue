<script setup>
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        route: String,
        icon: Object,
        showSlot: {
            type: Boolean,
            default: true
        },
        isActive: {
            type: Boolean,
            default: false
        }
    })
</script>

<template>
    <Link :href="route" class="text-white">
        <li class="flex w-full">
            <div class="flex flex-grow place-items-center">
                <div class="flex flex-grow gap-2 hover:text-black hover:bg-white place-items-center">
                    <FontAwesomeIcon :icon="icon" class="p-1 ml-3 text-2xl rounded-md" :class="{'active': isActive}"/>
                    <div v-show="showSlot" class="flex-grow font-medium" :class="{'underline' : isActive}">
                        <slot/>
                    </div>
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
