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

    const reset = {
        skills: [''],
    };

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
                reset.skills = [...content.my_skills];
                form.skills = [...content.my_skills];
                form.introduction = content.introduction;
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

    const removeFromList = (index) => {
        if (form.skills.length <= 1){
            showModalMessage('Skill list must have at least one value!', { type: 'error' });
        } else {
            form.skills.splice(index, 1);
        }
    }

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

    const resetSkills = () => {
        form.skills = [...reset.skills];
    }

    const form = useForm({
        skills: [''],
        introduction: '',
    });

    const updateHomeContent = () => {
        form.put(route('home.update'), {
            onSuccess: () => {
                showModalMessage(usePage().props.flash.success, { type: 'success' });
            },
            onError: () => {
                if (form.errors.page){
                    showModalMessage(form.errors.page, { type: 'error' });
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
    <DarkGlass class="min-h-screen p-2">
        <HeaderText class="mb-1">Home <span class="text-green-500 ">Page</span></HeaderText>
        <div class="px-4">
            <form @submit.prevent="updateHomeContent">
                <HeaderText class="mb-1">Skills</HeaderText>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <div class="mb-4" v-else>
                    <FieldMessage v-if="form.errors.skills" status="error">{{ form.errors.skills }}</FieldMessage>
                    <div v-for="(skill, index) in form.skills" :key="index" class="flex gap-2 mb-2 text-black">
                        <SkillInput v-model="form.skills[index]" class="flex-grow"/>
                        <DangerButton type="button" @click="removeFromList(index)">
                            <font-awesome-icon :icon="['fas', 'trash']"/>
                        </DangerButton>
                    </div>
                    <div class="flex gap-2">
                        <PrimaryButton type="button" @click="form.skills.push('')" class="flex gap-2 place-items-center">
                            <font-awesome-icon :icon="['fas', 'add']"/>
                            <span>Add Skill</span>
                        </PrimaryButton>
                        <PrimaryButton type="button" @click="resetSkills" class="flex gap-2 place-items-center">
                            <font-awesome-icon :icon="['fas', 'rotate-left']"/>
                            <span>Reset</span>
                        </PrimaryButton>
                    </div>
                </div>
                <HeaderText class="mb-1">Introduction</HeaderText>
                <FieldMessage v-if="form.errors.introduction" status="error">{{ form.errors.introduction }}</FieldMessage>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <RichTextEditorInput v-else v-model="form.introduction" class="mb-4"/>
                <hr>
                <div class="my-4">
                    <PrimaryButton type="submit" :disabled="form.processing">Save</PrimaryButton>
                </div>
            </form>
        </div>
    </DarkGlass>
</template>