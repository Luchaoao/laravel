<script>
// 引用 link
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


export default {
    components: {
        Link,
        AuthenticatedLayout,
    },
    props: {
        // books: {
        //     type: Array,
        // },
        // count: {
        //     type: Number,
        // },
        // title: {
        //     type: String,
        // },
        response: {
            type: Object,
        },
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Test</h2>
        </template>

        <div class="w-full h-screen bg-blue-400">
        <div v-for="book in response.books" :key="book.id">
            <div>書名：{{ book.name }}</div>
            <div>作者：{{ book.author }}</div>
        </div>
        <div>Count： {{ response.count }}</div>
        <div>Title： {{ response.title }}</div>
        <Link href="./">Back to homepage</Link>
    </div>
    </AuthenticatedLayout>
</template>