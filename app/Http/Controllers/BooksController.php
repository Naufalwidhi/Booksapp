<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Authors;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends BaseController
{
    public function index(){
        return Book::all();
    }
    public function getdataid(Request $request, $id)
    {
        $result = DB::select("SELECT * FROM books WHERE id = $id");
        if(empty($result)){
            return response()->json(['message'=> 'Book Not Found'], 404);
        }
        else{
        return $result;
        }
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'author' => 'required'
        ]);

        $book = Book::create(
            $request->only(['title', 'description', 'author'])
        );

        return response()->json([
            'created' => true,
            'data' => $book
        ], 201);
    }

    public function update(Request $request, $id){
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }

        $book->fill(
            $request->only(['title', 'description', 'author'])
        );
        $book->save();

        return response()->json([
            'updated' => true,
            'data' => $book
        ], 200);
    }

    public function destroy($id){
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                'message' => 'book not found'
                ]
            ], 404);
        }
        $book->delete();
        return response()->json([
            'deleted' => true
        ], 200);
    }

    public function authors(){
        return Authors::all();
    }

    public function authorsid(Request $request, $id)
    {
        $result = DB::select("SELECT * FROM authors WHERE id = $id");
        if(empty($result)){
            return response()->json(['message'=> 'Authors Not Found'], 404);
        }
        else{
        return $result;
        }
    }

    public function authorsadd(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'biography' => 'required'
        ]);

        $authors = Authors::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $authors
        ], 201);
    }

    public function authorsupdate(Request $request, $id){
        try {
            $authors = Authors::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Authors not found'
            ], 404);
        }

        $authors->fill(
            $request->only(['name', 'gender', 'biography'])
        );
        $authors->save();

        return response()->json([
            'updated' => true,
            'data' => $authors
        ], 200);
    }

    public function authorsdestroy($id){
        try {
            $authors = Authors::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                'message' => 'Authors not found'
                ]
            ], 404);
        }
        $authors->delete();
        return response()->json([
            'deleted' => true
        ], 200);
    }

}
