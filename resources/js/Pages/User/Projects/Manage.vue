<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { DarkGlass, HeaderText, PrimaryButton, ProjectCard, Loading, SearchInput, PaginationControls } from '@/Utils/MyComponents';
    import { nextTick, onMounted, computed, watch, reactive } from 'vue';
    import { debounce } from 'lodash';

    const projects = reactive({
        loading: {
            finished: false,
            status: 'loading',
        },
        data: [],
        links: [],
    });

    const options = reactive({
        search: '',
        sort_by: 'alphabetical',
        page: 1,
    });

    const fetchProjects = async () => {
        try{
            projects.loading.finished = false;
            projects.loading.status = 'loading';
            const response = await axios.post(route('api.fetch-projects'), options)
            const data = response.data;
            if (data.success) {
                projects.data = data.projects.data;
                projects.links = data.projects.links;
            } else {
                throw new Error(data.message || 'Failed to fetch projects');
            }
        } catch (err) {
            showModalMessage("Error: " + err.message, { type: 'error' });
            projects.loading.status = 'error';
        } finally {
            projects.loading.finished = true;
        }
    }

    const isLoading = computed(() => {
        const loadingVal = projects.loading;
        if (loadingVal.finished){
            if (loadingVal.status =='error'){
                return true;
            }
            return false;
        }
        return true;
    });

    const search = debounce((e) => {
        options.search = e.target.value;
    }, 1000);

    const isActiveSortBy = (sort_by) => {
        return options.sort_by == sort_by ? true : false;
    }

    const deleteProject = (id, index) => {
        showConfirmationModal("Are you sure you want to delete this project?",{
            onYes: async () => {
                try{
                    projects.data[index].isDeleting = true;
                    const response = await axios.delete(route('projects.delete', id));
                    const data = response.data;
                    if (data.success) {
                        projects.data.splice(index, 1);
                        showModalMessage(data.message);
                    } else {
                        throw new Error(data.message || 'Failed to delete project');
                    }
                } catch (err) {
                    showModalMessage("Error: " + err.message, { type: 'error' });
                }
            }
        });
    }

    onMounted(async () => {
        await nextTick();
        await fetchProjects();
    });

    watch(options, async () => {
        await nextTick();
        await fetchProjects();
    });
</script>

<template>
    <Head title="Projects"/>
    <DarkGlass class="min-h-[90vh] p-2 flex flex-col">
        <HeaderText class="mb-2">Manage <span class="text-green-500 ">Projects</span></HeaderText>
        <div class="flex flex-col justify-between flex-grow px-4">
            <div class="flex flex-col flex-grow">
                <div class="flex gap-2 mt-2 place-items-center">
                    <SearchInput @input="search" placeholder="Search..." class="w-full"/>
                </div>
                <div class="flex justify-between p-2 my-2 border-2 border-white rounded-md bg-slate-950">
                    <div>
                        <div class="text-xs">Sort by:</div>
                        <div class="flex gap-2 sort-buttons">
                            <button @click="options.sort_by = 'alphabetical'" class="border-b-4 border-transparent" :class="{'border-white': isActiveSortBy('alphabetical')}">A-Z</button>
                            <button @click="options.sort_by = 'newest'" class="border-b-4 border-transparent" :class="{'border-white': isActiveSortBy('newest')}">Newest</button>
                            <button @click="options.sort_by = 'views'" class="border-b-4 border-transparent" :class="{'border-white': isActiveSortBy('views')}">Views</button>
                        </div>
                    </div>
                    <div class="flex place-items-center">
                        <Link :href="route('projects.add')">
                            <PrimaryButton class="flex gap-2 place-items-center">
                                <font-awesome-icon :icon="['fas', 'add']"/>
                                <span>Add New</span>
                            </PrimaryButton>
                        </Link>
                    </div>
                </div>
                <Loading v-if="isLoading" :finished="projects.loading.finished" :status="projects.loading.status" class="flex justify-center flex-grow place-items-center"/>
                <div v-else>
                    <div v-if="projects.data.length" class="flex flex-wrap justify-start w-full">
                        <div v-for="(project, index) in projects.data" :key="project.id" class="w-full p-1 md:w-1/3">
                            <ProjectCard :project="project" :editable="true" :onDelete="() => { deleteProject(project.id, index) }" :isDeleting="project.isDeleting"/>
                        </div>
                    </div>
                    <div v-else class="m-10 text-center">
                        No result
                    </div>
                </div>
            </div>
            <div>
                <PaginationControls v-model="options.page" :links="projects.links" class="my-2"/>
            </div>
        </div>
    </DarkGlass>
</template>