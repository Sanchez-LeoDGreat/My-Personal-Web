<script setup>
    import { HeaderText, Loading, RichTextEditorInput, PrimaryButton, SkillInput, FieldMessage, DangerButton, DarkGlass } from '@/Utils/MyComponents';
    import { useForm, Head, usePage } from '@inertiajs/vue3';
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
                form.skills = content.my_skills;
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
        skills: [''],
        introduction: '',
    });

    const updateHomeContent = () => {
        form.put(route('home.update'), {
            onSuccess: () => {
                showModalMessage(usePage().props.flash.success);
            },
            onError: () => {
                if (form.errors.page){
                    showModalMessage(form.errors.page, 'error');
                }
            }
        });
    }

    onMounted(async () => {
        await nextTick();
        await getPageContent();
    });
</script>

<template>
    <Head title="Home (Edit)"/>
    <DarkGlass class="p-2 min-h-screen">
        <HeaderText class="mb-1">Home <span class="text-green-500 ">Page</span></HeaderText>
        <div class="px-4">
            <form @submit.prevent="updateHomeContent">
                <HeaderText class="mb-1">Skills</HeaderText>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <div class="mb-4" v-else>
                    <FieldMessage v-if="form.errors.skills" status="error">{{ form.errors.skills }}</FieldMessage>
                    <div v-for="(skill, index) in form.skills" :key="index" class="mb-2 flex gap-2 text-black">
                        <SkillInput v-model="form.skills[index]" class="flex-grow"/>
                        <DangerButton type="button" @click="form.skills.splice(index, 1)">
                            <font-awesome-icon :icon="['fas', 'trash']"/>
                        </DangerButton>
                    </div>
                    <PrimaryButton type="button" @click="form.skills.push('')" class="flex gap-2 place-items-center">
                        <font-awesome-icon :icon="['fas', 'add']"/>
                        <span>Add Skill</span>
                    </PrimaryButton>
                </div>
                <HeaderText class="mb-1">Introduction</HeaderText>
                <FieldMessage v-if="form.errors.introduction" status="error">{{ form.errors.introduction }}</FieldMessage>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <RichTextEditorInput v-else v-model="form.introduction" class="mb-4"/>
                <PrimaryButton type="submit" :disabled="form.processing">Save</PrimaryButton>
            </form>
        </div>
    </DarkGlass>
</template>