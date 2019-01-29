<?php

use Lib\Bookshelf\Interactors\AddBook;
use Lib\Bookshelf\Mail\BookAddedNotification;
use Lib\Bookshelf\Book;
use Illuminate\Support\Facades\Mail;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AddBookTest extends TestCase
{ 
    use DatabaseTransactions;

    private function interactor()
    {
        return $this->app->make(AddBook::class);
    }

    private function bookAttributes()
    {
        return [
            "author" => "James Baldwin", 
            'title' => "The Fire Next Time",
        ];
    }

    private function subjectCall()
    {
        return $this->interactor()($this->bookAttributes());
    }
    
    public function testSucceeds()
    {
        $result = $this->subjectCall();
        $this->assertTrue($result->successful());
    }

    public function testCreateBook()
    {
        $result = $this->subjectCall();
        $this->assertEquals("The Fire Next Time", $result->book->title);
        $this->assertEquals("James Baldwin", $result->book->author);
    }

    public function testPersistsBook()
    {
        $repository = Mockery::mock(Book::class);
        $this->app->instance(Book::class, $repository);
        $attributes = [
            "author" => "James Baldwin", 
            'title' => "The Fire Next Time",
        ];

        $repository->expects()->create($attributes);
        $this->subjectCall($attributes);
        // $result = $this->subjectCall();
        // $this->assertNotNull($result->book->id);
    }

    public function testSendMail()
    {
        Mail::fake();
        $this->subjectCall();
        Mail::assertSent(BookAddedNotification::class, 1);
    }
}
