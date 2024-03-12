<script>
export default {
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
    <div class="w-full h-screen bg-blue-400">
        <div v-for="book in response.books" :key="book.id">
            <div>書名：{{ book.name }}</div>
            <div>作者：{{ book.author }}</div>
        </div>
        <div>Count： {{ response.count }}</div>
        <div>Title： {{ response.title }}</div>
    </div>
</template>