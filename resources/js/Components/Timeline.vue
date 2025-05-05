<script setup>
    import { PrimaryButton } from '@/Utils/MyComponents';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        rows: {
            type: Array,
            required: true,
        },
        editable: {
            type: Boolean,
            default: false,
        }
    });

    const initialRows = ref([]);

    onMounted(() => {
        initialRows.value = JSON.parse(JSON.stringify(props.rows));
    });

    const addNew = () => {
        props.rows.push({
            timespan: 'Timespan',
            title: 'Title',
            content: 'Content here',
        });
    }

    const removeFromRow = (index) => {
        if (props.rows.length <= 1){
            showModalMessage('Timeline must at least contain one row!', 'error');
        } else {
            props.rows.splice(index, 1);
        }
    }

    const resetRows = () => {
        props.rows.splice(0, props.rows.length, ...JSON.parse(JSON.stringify(initialRows.value)));
    }

    const allowDrop = (e) => {
        if (props.editable){
            e.preventDefault();
        }
    }

    const dragStart = (e) => {
        if (props.editable){
            const timelineContent = $(e.target).find('.timeline-content');
            const title = timelineContent.find('.title');
            const timespan = timelineContent.find('.timespan');
            const content = timelineContent.find('.content');
            const draggedIndex = timelineContent.attr('data-id');

            e.dataTransfer.setData('dragged-index', parseInt(draggedIndex));
            e.dataTransfer.setData('dragged-title', title.html());
            e.dataTransfer.setData('dragged-timespan', timespan.html());
            e.dataTransfer.setData('dragged-content', content.html());
        }
    }

    const switchData = (e) => {
        e.preventDefault();
        const timelineContent = $(e.target).closest('.timeline-content');
        if (timelineContent.length) {
            const dropedIndex = timelineContent.attr('data-id');
            const droppedTitle = timelineContent.find('.title');
            const droppedTimespan = timelineContent.find('.timespan');
            const droppedContent = timelineContent.find('.content');

            const draggedIndex = e.dataTransfer.getData('dragged-index');
            const draggedTitle = e.dataTransfer.getData('dragged-title');
            const draggedTimespan = e.dataTransfer.getData('dragged-timespan');
            const draggedContent = e.dataTransfer.getData('dragged-content');

            props.rows[dropedIndex].title = draggedTitle;
            props.rows[dropedIndex].timespan = draggedTimespan;
            props.rows[dropedIndex].content = draggedContent;

            props.rows[draggedIndex].title = droppedTitle.html();
            props.rows[draggedIndex].timespan = droppedTimespan.html();
            props.rows[draggedIndex].content = droppedContent.html();
        }
    }

    const updateRowField = (index, field, event) => {
        if (props.editable){
            props.rows[index][field] = event.target.innerText;
        }
    }
</script>

<template>
    <div class="timeline">
        <div v-for="(row, index) in rows" class="timeline-row">
            <div class="container" :draggable="editable" @dragstart="dragStart" @dragover="allowDrop" @drop="switchData" :class="index % 2 ? 'right-container' : 'left-container'">
                <div class="timeline-box">
                    <div class="timeline-content" :data-id="index">
                        <p v-if="row.title" :contenteditable="editable" class="text-xl font-bold text-green-500 title md:text-center" @blur="updateRowField(index, 'title', $event)" v-html="row.title"></p>
                        <p v-if="row.timespan" class="flex gap-2 font-medium text-green-500 md:justify-center place-items-center">
                            <font-awesome-icon :icon="['fas', 'calendar']"/>
                            <span class="timespan" :contenteditable="editable" @blur="updateRowField(index, 'timespan', $event)" v-html="row.timespan"></span>
                        </p>
                        <p v-if="row.content" class="text-justify content" :contenteditable="editable" @blur="updateRowField(index, 'content', $event)" v-html="row.content"></p>
                        <div v-if="editable" class="absolute top-0 right-0">
                            <button type="button" @click="removeFromRow(index)" title="Remove" class="px-4 py-2 text-red-500 hover:text-red-900">
                                <font-awesome-icon :icon="['fas', 'trash']"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="editable" class="flex justify-between gap-2 my-4">
        <PrimaryButton @click="addNew" type="button">
            <font-awesome-icon :icon="['fas', 'add']"/>
            <span>Add New</span>
        </PrimaryButton>
        <PrimaryButton @click="resetRows" type="button">
            <font-awesome-icon :icon="['fas', 'rotate-left']"/>
            <span>Reset</span>
        </PrimaryButton>
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
