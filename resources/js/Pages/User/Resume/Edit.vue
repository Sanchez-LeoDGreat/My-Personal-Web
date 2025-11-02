<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { nextTick, onMounted, ref } from 'vue';
    import { Resume, DarkGlass, HeaderText, PrimaryButton } from '@/Utils/MyComponents';

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
    <DarkGlass class="min-h-[90vh] p-2 flex flex-col">
        <HeaderText class="mb-2">Edit <span class="text-green-500 ">Resume</span></HeaderText>
        <div class="my-4">
            <Link :href="route('user.resume')" class="inline-block">
                <PrimaryButton class="flex gap-2 place-items-center">
                    <font-awesome-icon :icon="['fas', 'angle-left']"/>
                    <span>Go Back</span>
                </PrimaryButton>
            </Link>
        </div>
        <Resume v-model="resume" :editable="true"/>
    </DarkGlass>
</template>