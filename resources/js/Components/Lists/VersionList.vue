<script setup>
    import { formattedDate } from '@/Utils/StringUtils';
    import { PrimaryButton, DangerButton, WarningButton } from '@/Utils/MyComponents';

    const props = defineProps({
        versions: {
            type: Array,
            required: true,
        },
        editable: {
            type: Boolean,
            default: false,
        }
    });
</script>

<template>
    <div>
        <div class="overflow-y-auto max-h-40">
            <table class="w-full table-auto">
                <thead class="sticky top-0 text-sm bg-slate-950">
                    <tr>
                        <th class="p-2">Version</th>
                        <th class="p-2">Uploaded at</th>
                        <th v-if="editable" class="p-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-black bg-white">
                    <tr v-for="(version, index) in versions" :key="version.id" class="text-sm border-2" :class="{'border-slate-950': index !== versions.length - 1}">
                        <td v-text="version.version" class="px-2 cursor-pointer hover:underline"></td>
                        <td v-text="formattedDate(version.created_at)" class="px-2"></td>
                        <td v-if="editable" class="flex justify-center">
                            <DangerButton type="button" class="flex gap-1 place-items-center">
                                <font-awesome-icon :icon="['fas', 'trash']"/>
                                <span>Delete</span>
                            </DangerButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-2">
            <PrimaryButton type="button" class="flex gap-2 place-items-center">
                <font-awesome-icon :icon="['fas', 'add']"/>
                <span>Add New</span>
            </PrimaryButton>
        </div>
    </div>
</template>