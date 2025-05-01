<script setup>
    import { HeaderText, Loading, RichTextEditorInput } from '@/Utils/MyComponents';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import { useForm, Head } from '@inertiajs/vue3';
    import { nextTick, onMounted, ref, computed } from 'vue';

    const pageContent = ref({
        loading: {
            finished: false,
            status: 'loading',
        },
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
                form.introduction = content.introduction;
            }
            else{
                throw new Error(data.message || 'Unknown error from API');
            }
        }
        catch (err){
            showModalMessage("<b>Error: </b>" + err?.message, 'error');
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

    const form = useForm({
        introduction: '',
    });

    onMounted(async () => {
        await nextTick();
        await getPageContent();
    });
</script>

<template>
    <Head title="Home (Edit)"/>
    <MarginLayout>
        <HeaderText class="mb-1">Home <span class="text-green-500 ">Page</span></HeaderText>
        <div class="px-2">
            <form @submit.prevent>
                <HeaderText class="mb-1">Skills</HeaderText>
                <HeaderText class="mb-1">Introduction</HeaderText>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <RichTextEditorInput v-else v-model="form.introduction"/>
            </form>
        </div>
    </MarginLayout>
</template>