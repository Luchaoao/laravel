<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $rule = $request->rule ?? '0';

        if ($rule === '0') {
            $books = Book::get();
        } else if ($rule === '1') {
            $books = Book::where([
                ['author', '=', '123'],
            ])->get();
        }

        // $books = Book::get();
        // // dd(123);
        // $data = [
        //     'books' => $books,
        //     'count' => 5,
        //     'title' => 'Midnight',
        // ];

        // $books = Book::where([
        //     ['author', '=', '123'],
        // ])->get();
        // dd($books);

        return Inertia::render('Test', [
            'response' => $books,
        ]);
    }

    public function store()
    {

        // 迴圈
        // $arr = [1, 2, 3, 4];
        // $newArr = [];

        // foreach ($arr as $item) {
        //     把每一個item + 1 後新增至 newArr
        //     array_push($newArr, $item + 1);

        //     印出但會往下執行
        //     dump($item);

        //     把每一個item後面放上文字新增至 newArr
        //     array_push($newArr, $item.'元');
        //     array_push($newArr, "{$item}元");
        // }
        // dd($newArr);

        // array_push 陣列
        // $data = [
        //     [
        //         'id' => 1,
        //         'name' => 'Almaz',
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Almazz',
        //     ],
        // ];
        // $newData = [];

        // foreach($data as $value) {
        //     dump($value['name']);
        //     array_push($newData, $value['name']);
        // }

        // dd($newData);

        // array_push 物件
        // $teachers = [
        //     (object) [
        //         'id' => 1,
        //         'name' => 'Almaz',
        //     ],
        //     (object) [
        //         'id' => 2,
        //         'name' => 'Almazz',
        //     ],
        // ];
        // $showTeachers = [];

        // foreach($teachers as $value) {
        //     dump($value -> name);
        //     array_push($showTeachers, $value->name);
        // }

        // dd($showTeachers);

        $books = [
            [
                'name' => 'Train History',
                'author' => 'unknown',
                'category' => '歷史',
                'ISBN' => '123',
                'pic' => 'none',
                'book_status' => '0',
                'test2' => '0'
            ],
            [
                'name' => 'Train History 2',
                'author' => 'unknown',
                'category' => '歷史',
                'ISBN' => '456',
                'pic' => 'none',
                'book_status' => '1',
                'test2' => '0'
            ],
        ];

        foreach ($books as $value) {
            Book::create($value);
        }

        // foreach($books as $value) {
        //     Book::create([
        //         'name' => $value['name'],
        //         'author' => $value['author'],
        //         'category' => $value['category'],
        //         'ISBN' => $value['ISBN'],
        //         'pic' => $value['pic'],
        //         'book_status' => $value['book_status'],
        //         'test2' => $value['test2']
        //     ]);
        // }

        // 重改變路線，導向/test路由，進而回到Test頁面
        return redirect('/test');
    }

    // 新增書本
    public function add(Request $request)
    {
        // dd($request->all());

        $message = '';

        try {
            Book::create([
                'name' => $request->name,
                'author' => $request->author,
                'category' => $request->category,
                'book_status' => $request->bookStatus,
            ]);
            $message = 'success';
        } catch (\Throwable $th) {
            $message = 'fail';
        }

        // 回到test頁面
        return redirect('/test')->with(['message' => $message]);
    }

    // 新增書本
    public function deleteBook(Request $request)
    {
        // dd($request->all());
        // 將指定id書本裝至$book內
        $book = Book::find($request->id);

        $message = '';

        // 書是否存在
        if ($book) {
            // 刪除指定書本
            $book->delete();
            $message = 'success';
        } else {
            $message = 'fail';
        }

        // 回到test頁面
        return redirect('/test')->with(['message' => $message]);
    }

    public function updateBook(Request $request)
    {
        $message = '';

        try {
            // 找到指定id的書本並賦值給$book
            $book = Book::find($request->id);

            $book->update([
                'name' => $request->name,
                'author' => $request->author,
                'category' => $request->category,
                'book_status' => $request->book_status,
            ]);

            $message = '成功';
        } catch (\Throwable $th) {
            $message = '失敗';
        }


        // 回到Test頁面
        return redirect('/test')->with(['message' => $message]);
    }

    public function uploadFile(Request $request)
    {

        // $file = $request->file;
        // // dd($file);

        // // 檢查是否有upload資料夾，如果沒有則建立一個upload資料夾
        // if (!is_dir('upload/')) {
        //     mkdir('upload/');
        // }

        // // 拿到檔案名稱
        // $fileName = $file->getClientOriginalName();

        // // 組成檔案路徑
        // $path = public_path() . '/upload/' . $fileName;

        // // 將文件存入指定路徑
        // move_uploaded_file($file, $path);

        $message = '';

        try {
            $file = $request->file;

            // 檢查是否有upload資料夾，如果沒有則建立一個upload資料夾
            if (!is_dir('upload/')) {
                mkdir('upload/');
            }

            // 拿到檔案名稱
            $fileName = $file->getClientOriginalName();

            // 組成檔案路徑
            $path = public_path() . '/upload/' . $fileName;

            // 將文件存入指定路徑
            move_uploaded_file($file, $path);

            $message = '成功';
        } catch (\Throwable $th) {
            $message = '失敗';
        }

        return redirect('/test')->with(['message' => $message]);
    }
}
