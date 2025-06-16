<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import UserTable from './UserTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

const users = usePage().props.users;

const page = usePage();
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
                :href="route('users.create')"
                class="border-sidebar-border/70 dark:border-sidebar-border primary-button absolute top-4 right-2 cursor-pointer self-end rounded-md border px-4 py-2 hover:bg-purple-200"
            >
                Create
            </Link>
            <!-- <div v-if="page.props.flash && page.props.flash.success" class="mb-4 rounded bg-green-100 p-4 text-green-700">
                {{ page.props.flash.success }}
            </div> -->
            <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border md:min-h-min">
                <!-- start user table -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <UserTable :users="users" />
                </div>
                <!-- end user table -->
            </div>
        </div>
    </AppLayout>
</template>
