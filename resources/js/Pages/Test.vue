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
    },
    data() {
        return {
            name: '',
            author: '',
            category: '',
            bookStatus: '',
            editname: '',
            editauthor: '',
            editcategory: '',
            editbookStatus: '',
            editId: '',
        };
    },
    methods: {
        addBook() {
            // 發送get請求
            // this.$inertia.get('/add-book');

            // 發送post請求
            this.$inertia.post('/post-book', {
                name: this.name,
                author: this.author,
                category: this.category,
                bookStatus: this.bookStatus,
            }, {
                onSuccess: (res) => {
                    const msg = res.props.flash.message;
                    alert(msg);
                }
            });
            this.name = '';
            this.author = '';
            this.category = '';
            this.bookStatus = '';
        },

        deleteBook(id) {
            this.$inertia.post('/delete-book', { id: id }, {
                onSuccess: (res) => {
                    const msg = res.props.flash.message;
                    alert(msg);
                }
            });
        },

        editBook(id) {
            const book = this.response.books.find(item => item.id === id);
            this.editId = id;
            this.editname = book.name;
            this.editauthor = book.author;
            this.editcategory = book.category;
            this.editbookStatus = book.bookStatus;
        },

        updateBook() {
            this.$inertia.post('update-book',
                {
                    id: this.editId,
                    name: this.editname,
                    author: this.editauthor,
                    category: this.editcategory,
                    bookStatus: this.editbookStatus,
                },
                {
                    onSuccess: (res) => {
                        const msg = res.props.flash.message;
                        alert(msg);
                    }
                }
            );
        }
    },
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Test</h2>
        </template>

        <div class="w-full h-screen bg-blue-400 flex flex-col items-center p-4">
            <Link href="./" class="block border border-black p-2 mt-3 mb-2 rounded">Back to homepage</Link>

            <div v-for="book in response.books" :key="book.id">
                <div>書名：{{ book.name }}</div>
                <div>作者：{{ book.author }}</div>
                <button type="button" class="block border border-black p-2 mt-3 mb-3 rounded"
                    @click="deleteBook(book.id)">Delete book</button>
                <button type="button" class="block border border-black p-2 mt-3 mb-3 rounded"
                    @click="editBook(book.id)">Edit
                    book</button>
            </div>
            <!-- <div>Count： {{ response.count }}</div>
            <div>Title： {{ response.title }}</div> -->
            <form class="mt-3 flex flex-col">
                <label for="">
                    <span class="me-2">更改書名</span>
                    <input v-model="editname" type="text" placeholder="請輸入書名" class="mb-2 rounded">
                </label>
                <label for="">
                    <span class="me-2">更改作者</span>
                    <input v-model="editauthor" type="text" placeholder="請輸入作者" class="rounded">
                </label>
                <label for="">
                    <span class="me-2">更改分類</span>
                    <input v-model="editcategory" type="text" placeholder="請輸入分類" class="rounded">
                </label>
                <label for="">
                    <span class="me-2">更改狀態</span>
                    <input v-model="editbookStatus" type="text" placeholder="請輸入狀態" class="rounded">
                </label>
            </form>


            <form class="mt-3 flex flex-col">
                <label for="">
                    <span class="me-2">書名</span>
                    <input v-model="name" type="text" placeholder="請輸入書名" class="mb-2 rounded">
                </label>
                <label for="">
                    <span class="me-2">作者</span>
                    <input v-model="author" type="text" placeholder="請輸入作者" class="rounded">
                </label>
                <label for="">
                    <span class="me-2">分類</span>
                    <input v-model="category" type="text" placeholder="請輸入分類" class="rounded">
                </label>
                <label for="">
                    <span class="me-2">狀態</span>
                    <input v-model="bookStatus" type="text" placeholder="請輸入狀態" class="rounded">
                </label>
            </form>
            <button type="button" class="block border border-black p-2 mt-3 rounded" @click="addBook">Add new
                book</button>
        </div>
    </AuthenticatedLayout>
</template>