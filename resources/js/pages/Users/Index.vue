<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

const users = usePage().props.users;
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
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <!-- start user table -->

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Mobile</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="user in users"
                                :key="user.id"
                                class="border-b border-gray-200 odd:bg-white even:bg-gray-50 dark:border-gray-700 odd:dark:bg-gray-900 even:dark:bg-gray-800"
                            >
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white">{{ user.name }}</th>
                                <td class="px-6 py-4">{{ user.email }}</td>
                                <td class="px-6 py-4">User</td>
                                <td class="px-6 py-4">01865432121</td>
                                <td class="px-6 py-4">
                                    <a
                                        href="{{ route('users.edit', user.id) }}"
                                        class="p-2 font-medium text-blue-600 hover:underline dark:text-blue-500"
                                        >Edit</a
                                    >
                                    <a href="#" class="p-2 font-medium text-red-600 hover:underline dark:text-blue-500">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end user table -->
            </div>
        </div>
    </AppLayout>
</template>
