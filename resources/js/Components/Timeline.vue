<script setup>
    defineProps({
        rows: {
            type: Array,
            required: true,
        }
    });
</script>

<template>
    <div class="timeline">
        <div v-for="(row, index) in rows" class="timeline-row">
            <div class="container" :class="index % 2 ? 'right-container' : 'left-container'">
                <div class="timeline-box">
                    <div class="timeline-content">
                        <p class="text-xl font-bold text-green-500 md:text-center">{{ row.title }}</p>
                        <p class="flex gap-2 font-medium text-green-500 md:justify-center place-items-center">
                            <font-awesome-icon :icon="['fas', 'calendar']"/>
                            <span>{{ row.timespan }}</span>
                        </p>
                        <p class="text-justify" v-html="row.content"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .timeline{
        @apply w-full flex flex-col gap-4 relative
        after:absolute after:inset-y-0 after:w-2 after:bg-green-500
        after:left-0 md:after:left-1/2 md:after:-translate-x-1/2
        after:rounded-full after:-z-10
    }

    .timeline-row{
        @apply flex justify-center
    }

    .container{
        @apply w-full flex relative
    }

    .left-container{
        @apply justify-start
    }

    .right-container{
        @apply justify-end
    }

    .timeline-box{
        @apply md:w-1/2 w-full relative
    }

    .timeline-content{
        @apply bg-slate-950/60 backdrop-blur-sm rounded-md px-4 py-2
        hover:shadow-green-300 hover:shadow-md after:bg-green-500 after:hover:bg-green-200
        after:absolute after:top-1/2 after:-translate-y-1/2 after:hover:shadow-green-300 after:shadow-md
        after:rounded-full after:h-6 after:w-6 border-[1px] border-white
    }

    .left-container .timeline-content{
        @apply md:ml-2 md:mr-6 after:-left-8 md:after:-right-9 md:after:left-auto ml-6
    }

    .right-container .timeline-content{
        @apply md:mr-2 ml-6 after:-left-8 md:after:-left-9
    }
</style>
