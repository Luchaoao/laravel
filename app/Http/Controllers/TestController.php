<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $books = Book::get();
        // dd(123);
        $data = [
            'books' => $books,
            'count' => 5,
            'title' => 'Midnight',
        ];

        return Inertia::render('Test', [
            'response' => $data,
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
        }catch (\Throwable $th) {
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

    // public function updateBook(Request $request)
    // {
    //     $book = Book::find($request->id);

    //     try {
    //         Book::create([
    //             'name': $request->name,
    //         ]);
    //         $message = 'success';
    //     }catch (\Throwable $th) {
    //         $message = 'fail';
    //     }

    //     // 回到test頁面
    //     return redirect('/test')->with(['message' => $message]);
    // }
}
