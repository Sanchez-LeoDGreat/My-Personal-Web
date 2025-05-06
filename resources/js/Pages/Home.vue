<script setup>
    import { Head } from '@inertiajs/vue3';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import StaticAsset from '@/Utils/StaticAsset';
    import { HeaderText, DarkGlass, TypeWriter, Loading, Prose } from '@/Utils/MyComponents';
    import { nextTick, onMounted, ref, computed } from 'vue';

    const pageContent = ref({
        loading: {
            finished: false,
            status: 'loading',
        },
        mySkills: [],
        introduction: null,
    });

    const getPageContent = async () => {
        try{
            const response = await axios.get(route('api.get-page-content'), {
                params: {
                    name: 'home',
                },
            });
            const data = response.data;
            if (data.success){
                const content = data.content;
                pageContent.value.mySkills = content.my_skills;
                pageContent.value.introduction = content.introduction;
            }
            else{
                throw new Error(data.message || 'Unknown error from API');
            }
        }
        catch (err){
            showModalMessage("<b>Error: </b>" + err?.message, { type: 'error' });
            pageContent.value.loading.status = 'error';
        }
        finally{
            pageContent.value.loading.finished = true;
        }
    };

    const isLoading = computed(() => {
        const loadingVal = pageContent.value.loading;
        if (loadingVal.finished){
            if (loadingVal.status =='error'){
                return true;
            }
            return false;
        }
        return true;
    });

    onMounted(async () => {
        await nextTick();
        getPageContent();
    });
</script>

<template>
    <Head title="Home"/>
    <MarginLayout class="flex flex-grow">
        <DarkGlass class="flex flex-grow my-2 border-white border-[1px] md:place-items-center">
            <div class="flex flex-col gap-8 m-10 md:gap-0 md:flex-row md:place-items-center">
                <div class="md:w-[55%]">
                    <HeaderText class="text-3xl">Leonard Paulo Sanchez</HeaderText>
                    <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                    <div v-else>
                        <HeaderText>
                            <span>I'm </span><TypeWriter class="inline" :strings="pageContent.mySkills"/>
                        </HeaderText>
                        <Prose v-html="pageContent.introduction"></Prose>
                    </div>
                    <button class="px-4 py-2 my-2 font-medium text-black transition-all bg-white rounded-full hover:shadow-green-500 hover:shadow-md active:shadow-blue-500 active:text-blue-500">Download CV</button>
                </div>
                <div class="md:w-[45%]">
                    <img :src="StaticAsset.img.hero" alt="hero.png">
                </div>
            </div>
        </DarkGlass>
    </MarginLayout>
</template>
