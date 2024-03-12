<script>
export default {
    props: {
        books: {
            type: Array,
        },
        count: {
            type: Number,
        },
        title: {
            type: String,
        },
    }
}
</script>

<template>
    <div class="w-full h-screen bg-blue-400">
        <div>書名：{{ books[0].name }}</div>
        <div>Count： {{ count }}</div>
        <div>Title： {{ title }}</div>
    </div>
</template>