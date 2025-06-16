<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const page = usePage();
const visible = ref(false);
const message = ref('');

watch(
    () => page.props.flash.success,
    (newVal) => {
        if (newVal) {
            message.value = newVal;
            visible.value = true;

            setTimeout(() => {
                visible.value = false;
                message.value = '';
            }, 5000); // auto hide after 4 seconds
        }
    },
    { immediate: true },
);
</script>

<template>
    <transition name="fade">
        <div v-if="visible" class="fixed right-5 bottom-5 z-50 rounded bg-green-100 px-4 py-3 text-green-800 shadow-md">
            {{ message }}
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
