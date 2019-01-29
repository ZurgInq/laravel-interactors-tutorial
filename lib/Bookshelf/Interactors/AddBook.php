<?php

namespace Lib\Bookshelf\Interactors;

use Lib\Interactor\Interactor;
use Lib\Bookshelf\Book;
use Lib\Bookshelf\Mail\BookAddedNotification;
use Illuminate\Support\Facades\Mail;

class AddBook
{
    use Interactor;
    protected static $expose = ["book"];
    private $book = null;
    
    public function __construct(Book $repository, BookAddedNotification $mail)
    {
        $this->repository = $repository;
        $this->mail = $mail;
    }

    protected function call($bookAttributes)
    {
        // $this->book = new Book($bookAttributes);
        // $this->book = Book::create($bookAttributes);

        $this->book = $this->repository->create($bookAttributes);
        Mail::send($this->mail);
    }
}