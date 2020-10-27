<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
}
