<script setup>
    import { Head } from '@inertiajs/vue3';
    import MarginLayout from '@/Layouts/Child/MarginLayout.vue';
    import StaticAsset from '@/Utils/StaticAsset.js';
    import { faHtml5, faCss3Alt, faJs, faPhp, faWordpress, faLaravel, faVuejs } from '@fortawesome/free-brands-svg-icons';
    import { computed, nextTick, onMounted, ref } from 'vue';
    import { HeaderText, DarkGlass, Timeline, IconCard, Modal, ModalMessage, ModalButtons, SecondaryButton, Loading } from '@/Utils/MyComponents';

    const pageContent = ref({
        loading: {
            finished: false,
            status: 'loading',
        },
        aboutMe: null,
        expTimeline: {
            rows: []
        },
    })

    const modal = ref({
        show: false,
        type: null,
        message: null,
    });

    const showModal = (type, msg) => {
        modal.value.show = true;
        modal.value.type = type;
        modal.value.message = msg;
    }

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
                pageContent.value.aboutMe = content.about_me;
                pageContent.value.expTimeline.rows = content.exp_timeline;
            }
            else{
                showModal('error', "<b>Error: </b>" + data.message);
                pageContent.value.loading.status = 'error';
            }
        }
        catch (err){
            showModal("error", "<b>Error: </b>" + err.message);
            pageContent.value.loading.status = 'error';
        }
        finally{
            pageContent.value.loading.finished = true;
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

    onMounted(async () => {
        await nextTick();
        getPageContent();
    });
</script>
<template>
    <Head title="About"/>
    <MarginLayout class="flex flex-grow">
        <DarkGlass class="border-white py-6 my-2 px-10 border-[1px] flex-col flex gap-6 flex-grow">
            <div>
                <HeaderText class="mb-1">About <span class="text-green-500 ">Me</span></HeaderText>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <p v-else class="text-justify" v-html="pageContent.aboutMe"></p>
            </div>
            <div>
                <HeaderText class="mb-2">My <span class="text-green-500">Skills</span></HeaderText>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <div v-else class="flex flex-wrap justify-start gap-2">
                    <!-- Languges and Stylesheets -->
                    <IconCard :icon="StaticAsset.svg.c" class="text-blue-500 shadow-blue-300">C Language</IconCard>
                    <IconCard :icon="StaticAsset.svg.cSharp" class="text-purple-500 shadow-purple-300">C# Language</IconCard>
                    <IconCard :icon="faHtml5" class="text-orange-500 shadow-orange-300">HTML5</IconCard>
                    <IconCard :icon="faCss3Alt" class="text-blue-500 shadow-blue-300">CSS</IconCard>
                    <IconCard :icon="StaticAsset.svg.tailwindCss" class="shadow-cyan-300">Tailwind CSS</IconCard>
                    <IconCard :icon="faJs" class="text-yellow-500 shadow-yellow-300">JavaScript</IconCard>
                    <IconCard :icon="faPhp" class="text-blue-500 shadow-blue-300">PHP</IconCard>
                    <IconCard :icon="StaticAsset.svg.python" class="shadow-yellow-300" iconClass="w-6">Python</IconCard>

                    <!-- Frameworks/Enginges etc. -->
                    <IconCard :icon="StaticAsset.svg.dotNet" class="shadow-purple-300">.NET Framework</IconCard>
                    <IconCard :icon="faWordpress" class="text-cyan-500 shadow-cyan-300">WordPress</IconCard>
                    <IconCard :icon="StaticAsset.svg.godot" class="shadow-blue-300">Godot</IconCard>
                    <IconCard :icon="StaticAsset.svg.odoo" class="shadow-purple-300" iconClass="w-10">Odoo</IconCard>
                    <IconCard :icon="faLaravel" class="text-orange-500 shadow-orange-300">Laravel</IconCard>
                    <IconCard :icon="faVuejs" class="text-green-500 shadow-green-300">VueJS</IconCard>
                </div>
            </div>
            <div>
                <HeaderText class="mb-2">My <span class="text-green-500">Experience</span></HeaderText>
                <Loading v-if="isLoading" :finished="pageContent.loading.finished" :status="pageContent.loading.status"/>
                <Timeline v-else :rows="pageContent.expTimeline.rows"/>
            </div>
        </DarkGlass>
    </MarginLayout>
    <Modal v-model:show="modal.show" :type="modal.type">
        <ModalMessage :message="modal.message"/>
        <ModalButtons>
            <SecondaryButton @click="modal.show=false" focus-on-show>OK</SecondaryButton>
        </ModalButtons>
    </Modal>
</template>
