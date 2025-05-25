<script setup>
    import { Head } from '@inertiajs/vue3';
    import { nextTick, onMounted, ref } from 'vue';

    const resume = ref(null);

    const fetchResume = async () => {
        try{
            const response = await axios.post(route('api.fetch-resume'));
            const data = response.data;
            if (data.success){
                resume.value = data.resume;
            } else {
                throw new Error(data.message || 'Failed to fetch resume');
            }
        } catch (err) {
            showModalMessage(`Error: ${err.message}`, { type: 'error' });
        }
    }

    onMounted(async () => {
        await nextTick();
        await fetchResume();
    });
</script>

<template>
    <Head title="Edit Resume"/>
</template>