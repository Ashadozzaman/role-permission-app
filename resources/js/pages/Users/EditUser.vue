<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Users',
        href: '/users',
    },
];

// Fallback to empty object if user is undefined
const page = usePage();
const user = page.props.user || {};

const form = useForm({
    name: user.name || '',
    email: user.email || '',
    password: '',
    password_confirmation: '',
});
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
                    Total User
                </div>
            </div> -->
            <Link
                :href="route('users.index')"
                class="border-sidebar-border/70 dark:border-sidebar-border primary-button absolute top-4 right-2 cursor-pointer self-end rounded-md border px-4 py-2 hover:bg-purple-200"
            >
                Back
            </Link>
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <!-- start user create form -->
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <form @submit.prevent="form.put(route('users.update', user.id))" class="mx-auto my-10 max-w-md rounded-xl bg-white p-6 shadow-md">
                        <div class="mb-4">
                            <label class="mb-1 block">Name</label>
                            <input v-model="form.name" type="text" class="w-full rounded border p-2" />
                            <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1 block">Email</label>
                            <input v-model="form.email" type="email" class="w-full rounded border p-2" />
                            <div v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1 block">Password</label>
                            <input v-model="form.password" type="password" class="w-full rounded border p-2" />
                            <div v-if="form.errors.password" class="text-sm text-red-500">{{ form.errors.password }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="mb-1 block">Confirm Password</label>
                            <input v-model="form.password_confirmation" type="password" class="w-full rounded border p-2" />
                            <div v-if="form.errors.password_confirmation" class="text-sm text-red-500">
                                {{ form.errors.password_confirmation }}
                            </div>
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
