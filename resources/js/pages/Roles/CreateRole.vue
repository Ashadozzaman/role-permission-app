<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Role',
        href: '/roles',
    },
];
defineProps({
    permissions: Array,
});
const form = useForm({
    name: '',
    permissions: [],
});
</script>

<template>
    <Head title="roles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <Link
                :href="route('roles.index')"
                class="border-sidebar-border/70 dark:border-sidebar-border primary-button absolute top-4 right-2 cursor-pointer self-end rounded-md border px-4 py-2 hover:bg-purple-200"
            >
                Back
            </Link>
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <!-- start user create form -->
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <form @submit.prevent="form.post(route('roles.store'))" class="mx-auto my-10 max-w-md rounded-xl bg-white p-6 shadow-md">
                        <div class="mb-4">
                            <label class="mb-1 block">Name</label>
                            <input v-model="form.name" type="text" class="w-full rounded border p-2" />
                            <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="mb-1 block">Permission</label>
                            <div v-for="permission in permissions" class="flex items-center">
                                <input
                                    v-model="form.permissions"
                                    :value="permission"
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4 rounded border p-2 text-blue-400 focus:ring-2 focus:ring-blue-400"
                                />
                                <span class="ml-2 text-gray-800 capitalize">{{ permission }}</span>
                            </div>
                            <div v-if="form.errors.permissions" class="text-sm text-red-500">{{ form.errors.permissions }}</div>
                        </div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 disabled:opacity-50"
                        >
                            Submit
                        </button>
                    </form>
                </div>
                <!-- end user create form -->
            </div>
        </div>
    </AppLayout>
</template>
