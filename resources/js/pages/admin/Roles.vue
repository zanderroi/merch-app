<template>
    <Head title="Roles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="md:text-md flex h-full flex-col gap-4 rounded-xl p-4 text-sm">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 p-4 md:min-h-min dark:border-sidebar-border">
                <Dialog>
                    <DialogTrigger as-child>
                        <button
                            class="mb-4 rounded-md bg-blue-700 px-4 py-2 text-white hover:scale-105 hover:border-2 hover:border-blue-700 hover:bg-white hover:text-blue-700"
                        >
                            Add Role
                        </button>
                    </DialogTrigger>
                    <DialogOverlay />
                    <DialogContent>
                        <DialogTitle>Add Role</DialogTitle>
                        <form class="mt-4 flex flex-col gap-4" @submit.prevent="form.post(route('admin.roles.create'))">
                            <label class="flex flex-col gap-1">
                                <span class="font-medium">Role Name</span>
                                <input type="text" class="rounded border px-2 py-1" placeholder="Enter role name" v-model="form.name" />
                            </label>
                            <div class="flex justify-end gap-2">
                                <DialogClose as-child>
                                    <button type="button" class="rounded bg-gray-200 px-4 py-2 hover:bg-gray-300">Cancel</button>
                                </DialogClose>

                                <DialogClose as-child>
                                    <button
                                        type="submit"
                                        class="rounded bg-blue-700 px-4 py-2 text-white hover:bg-blue-800"
                                        :disabled="form.processing"
                                    >
                                        Save
                                    </button>
                                </DialogClose>
                            </div>
                        </form>
                    </DialogContent>
                </Dialog>
                <AlertOverlay
                    v-if="page.props.flash.success"
                    type="success"
                    :message="page.props.flash.success"
                    :key="page.props.flash.success + Date.now()"
                />
                <AlertOverlay
                    v-if="page.props.flash.error"
                    type="error"
                    :message="page.props.flash.error"
                    :key="page.props.flash.error + Date.now()"
                />
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-2 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in roles" :key="role.id">
                            <td class="border border-gray-300 px-2 py-2">{{ role.id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ role.name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <button class="text-blue-500 hover:underline">Edit</button>
                                <button class="ml-2 text-red-500 hover:underline">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AlertOverlay from '@/components/ui/alert/AlertOverlay.vue';
import { Dialog, DialogClose, DialogContent, DialogOverlay, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const page = usePage();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role Management',
        href: '/admin/roles',
    },
];

defineProps({
    roles: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    name: '',
});
</script>

<style lang="scss" scoped></style>
