<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<script>
export default {
    methods: {
        sendMail() {
            this.$inertia.post('/send-email');
        },
    },
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    <button class="bg-gray-500 rounded ml-5 p-2 text-white mb-2" type="button" @click="sendMail()">寄信</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
