<script setup>
import { can } from '@/lib/can';
import { router } from '@inertiajs/vue3';
const props = defineProps(['roles']);

const deleterole = (id) => {
    if (confirm('Are you sure you want to delete this role?')) {
        router.delete(route('roles.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                router.visit(route('roles.index'), {
                    preserveScroll: true,
                    preserveState: false,
                });
            },
        });
    }
};
</script>
<template>
    <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Permission</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="role in roles"
                :key="role.id"
                class="border-b border-gray-200 odd:bg-white even:bg-gray-50 dark:border-gray-700 odd:dark:bg-gray-900 even:dark:bg-gray-800"
            >
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white">{{ role.name }}</th>
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                    <span
                        v-for="permission in role.permissions"
                        :key="permission.id"
                        class="mr-2 inline-block rounded-full bg-gray-100 px-2 py-1 text-sm font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-300"
                        >{{ permission.name }}</span
                    >
                </th>

                <td class="px-6 py-4">
                    <a
                        v-if="can('roles.update')"
                        :href="route('roles.edit', role.id)"
                        class="p-2 font-medium text-blue-600 hover:underline dark:text-blue-500"
                        >Edit</a
                    >
                    <button
                        v-if="can('roles.delete')"
                        @click="deleterole(role.id)"
                        class="p-2 font-medium text-red-600 hover:underline dark:text-blue-500"
                    >
                        Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
