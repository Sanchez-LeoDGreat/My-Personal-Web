<script setup>
    import { DarkGlass, HeaderText, Loading, RichTextEditorInput, Timeline, FieldMessage, PrimaryButton } from '@/Utils/MyComponents';
    import { Head, useForm, usePage } from '@inertiajs/vue3';
    import { ref, onMounted, computed, nextTick } from 'vue';

    const pageContent = ref({
        loading: {
            finished: false,
            status: 'loading',
        },
    });

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

    const getPageContent = async () => {
        try{
            const response = await axios.get(route('api.get-page-content'), {
                params: {
                    name: 'about',
                },
            });
            const data = response.data;
            if (data.success){
                const content = data.content;
                form.about_me = content.about_me;
                form.experience = content.exp_timeline;
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

    const form = useForm({
        about_me: null,
        experience: [''],
    });

    const updateAboutContent = () => {
        form.put(route('about.update'), {
            onSuccess: () => {
                showModalMessage(usePage().props.flash.success);
            },
            onError: () => {
                if (form.errors.page){
                    showModalMessage(form.errors.page, { type: 'error' });
                }
            }
        })
    }

    onMounted(async () => {
        await nextTick();
        await getPageContent();
    });
</script>

<template>
    <Head title="About (Edit)"/>
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">About <span class="text-green-500 ">Page</span></HeaderText>
        <div class="px-4">
            <form @submit.prevent="updateAboutContent">
                <div>
                    <HeaderText class="mb-1">About Me</HeaderText>
                    <FieldMessage v-if="form.errors.about_me" status="error">{{ form.errors.about_me }}</FieldMessage>
                    <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                    <RichTextEditorInput v-else v-model="form.about_me" class="mb-4"/>
                </div>
                <div>
                    <HeaderText class="mb-1">My Experience</HeaderText>
                    <FieldMessage v-if="form.errors.experience" status="error">{{ form.errors.experience }}</FieldMessage>
                    <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                    <Timeline v-else :editable="true" v-model:rows="form.experience"/>
                </div>
                <hr>
                <div class="my-4">
                    <PrimaryButton type="submit" :disabled="form.processing">
                        Save
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </DarkGlass>
</template>