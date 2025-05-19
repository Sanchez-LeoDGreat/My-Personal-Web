<script setup>
    defineProps({
        icon: {
            type: [String, Object],
            required: true,
        },
        iconClass: String,
    });
</script>

<template>
    <div class="flex gap-2 px-4 py-2 rounded-md shadow-sm backdrop-blur-sm bg-slate-950/5 place-items-center">
        <div class="text-xl min-w-4" :class="iconClass">
            <img v-if="typeof icon == 'string'" class="min-w-5" :src="icon" alt="card-icon">
            <font-awesome-icon v-else :icon="icon"/>
        </div>
        <div class="text-white">
            <slot/>
        </div>
    </div>
</template>
