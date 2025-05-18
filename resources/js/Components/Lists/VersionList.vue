<script setup>
    import { formattedDate } from '@/Utils/StringUtils';
    import { PrimaryButton, DangerButton } from '@/Utils/MyComponents';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        projectId: Number,
        versions: {
            type: Array,
            required: true,
        },
        editable: {
            type: Boolean,
            default: false,
        }
    });

    const goToAddProjectVersion = () => {
        router.visit(route('projects.add-version', { project_id: props.projectId }));
    }

    const goToEditProjectVersion = (versionId) => {
        router.visit(route('projects.edit-version', { version_id: versionId }));
    }

    const deleteProjectVersion = (index) => {
        if (props.versions.length > 1){
            showConfirmationModal("Are you sure you want to delete this project's version?", {
                type: 'warning',
                onYes: async () => {
                    const selectedVersion = props.versions[index];
                    try{
                        selectedVersion.isDeleting = true;
                        const response = await axios.delete(route('projects.delete-version'), {
                            params: {
                                downloadable_id: selectedVersion.id,
                            }
                        });
                        const data = response.data;
                        if (data.success){
                            props.versions.splice(index, 1);
                            showModalMessage(data.message, { type: 'success' });
                        } else {
                            throw new Error(data.message || 'Failed to delete project version');
                        }
                    } catch (err) {
                        showModalMessage('Error: ' + err.message, { type: 'error' });
                        selectedVersion.isDeleting = false;
                    }
                }
            });
        } else {
            showModalMessage('You cannot delete the last version of the project', { type: 'error' });
        }
    }
</script>

<template>
    <div>
        <div class="overflow-y-auto max-h-40">
            <table class="w-full table-auto">
                <thead class="sticky top-0 z-10 text-sm bg-slate-950">
                    <tr>
                        <th class="p-2 text-left">Version</th>
                        <th class="p-2 text-left">Uploaded at</th>
                        <th v-if="editable" class="p-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-black bg-white">
                    <tr v-for="(version, index) in versions" :key="version.id" class="relative text-sm" :class="{'border-slate-950 border-b-2': index !== versions.length - 1}">
                        <td class="px-2 cursor-pointer">
                            <button type="button" @click="goToEditProjectVersion(version.id)" class="hover:underline">{{ version.version }}</button>
                        </td>
                        <td v-text="formattedDate(version.created_at)" class="px-2"></td>
                        <td v-if="editable" class="flex justify-center">
                            <DangerButton type="button" @click="deleteProjectVersion(index)" class="flex gap-1 z-0 my-0.5 place-items-center">
                                <font-awesome-icon :icon="['fas', 'trash']"/>
                                <span>Delete</span>
                            </DangerButton>
                        </td>
                        <td v-if="version.isDeleting" class="absolute inset-0 bg-black/50" colspan="3">
                            <div class="flex justify-center h-full gap-1 text-white place-items-center">
                                <font-awesome-icon :icon="['fas', 'spinner']" class="text-xl animate-spin"/>
                                <span>Deleting</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="editable" class="my-2">
            <PrimaryButton @click="goToAddProjectVersion" type="button" class="flex gap-2 place-items-center">
                <font-awesome-icon :icon="['fas', 'add']"/>
                <span>Add New</span>
            </PrimaryButton>
        </div>
    </div>
</template>