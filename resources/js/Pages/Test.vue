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
        all: {
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
            fileData: null,
        };
    },
    methods: {
        addBook() {
            // 發送get請求
            // this.$inertia.get('/add-book');

            // 檢查是否有填寫書名，如沒有則跳提醒視窗
            if (!this.name || !this.author) {
                Swal.fire({
                    icon: "error",
                    title: "請填寫完整資料",
                });
                return;
            };

            Swal.fire({
                title: "確定要新增嗎?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // 發送post請求
                    this.$inertia.post('/post-book', {
                        name: this.name,
                        author: this.author,
                        category: this.category,
                        bookStatus: this.bookStatus,
                    }, {
                        onSuccess: (res) => {
                            const msg = res.props.flash.message;
                            Swal.fire(msg);
                        }
                    });
                    this.name = '';
                    this.author = '';
                    this.category = '';
                    this.bookStatus = '';
                }
            });

        },

        deleteBook(id) {
            Swal.fire({
                title: "確定要刪除嗎?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post('/delete-book', { id: id }, {
                onSuccess: (res) => {
                    const msg = res.props.flash.message;
                    Swal.fire(msg);
                }
            });
                }
            });
        },

        editBook(id) {
            const book = this.response.find(item => item.id === id);
            this.editId = id;
            this.editname = book.name;
            this.editauthor = book.author;
            this.editcategory = book.category;
            this.editbookStatus = book.book_status;
        },

        updateBook() {
            Swal.fire({
                title: "確定要修改嗎?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post('/update-book',
                        {
                            id: this.editId,
                            name: this.editname,
                            author: this.editauthor,
                            category: this.editcategory,
                            book_status: this.editbookStatus,
                        },
                        {
                            onSuccess: (res) => {
                                const msg = res.props.flash.message;
                                Swal.fire(msg);
                            }
                        });
                    this.editname = '';
                    this.editauthor = '';
                    this.editcategory = '';
                    this.editbookStatus = '';
                }
            });

        },

        filterBook(rule) {
            this.$inertia.get('/test', {
                rule: rule,
            });
        },

        putFile(e) {
            const file = e.target.files[0];
            this.fileData = file;
        },

        submitFile() {
            this.$inertia.post('/upload-file',
            {
                file: this.fileData,
            },{
                onSuccess: (res) => {
                    const msg = res.props.flash.message;
                    Swal.fire(msg);
                }
            });
        },
    },
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Test</h2>
        </template>

        <div class="w-full bg-blue-400 flex flex-col items-center p-4">
            <Link href="./" class="block border border-black p-2 mt-3 mb-2 rounded">Back to homepage</Link>
            <Link href="./" class="border border-black p-2 rounded cursor-pointer mb-2" @click="filterBook(0)">全部書籍
            </Link>
            <Link href="./" class="border border-black p-2 rounded cursor-pointer mb-5" @click="filterBook(1)">作者:123
            </Link>

            <div v-for="book in response" :key="book.id">
                <div>書名：{{ book.name }}</div>
                <div>作者：{{ book.author }}</div>
                <div>分類：{{ book.category }}</div>
                <div>狀態：{{ book.book_status }}</div>
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
            <button type="button"
                class="block mt-2 p-2 border border-black rounded text-white bg-blue-500 hover:bg-blue-500/50"
                @click="updateBook">save edit
            </button>

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

            <section class="flex mt-5">
            <input type="file" @change="putFile">
            <div class="cursor-pointer p-2 border border-black bg-green-500/50" @click="submitFile">上傳檔案</div>
        </section>
        </div>

        
    </AuthenticatedLayout>
</template>