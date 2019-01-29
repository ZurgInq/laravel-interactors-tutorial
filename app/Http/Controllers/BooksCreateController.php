<?php

namespace App\Http\Controllers;

use Lib\Bookshelf\Interactors\AddBook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BooksCreateController extends Controller
{    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AddBook $addBook)
    {
        $this->addBook = $addBook;
    }

    public function call(Request $request)
    {
        $input = $request->all();
        ($this->addBook)($input);
        return (new Response(null, 201));
    }
}
