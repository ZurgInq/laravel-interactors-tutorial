<?php

use Lib\Bookshelf\Mail\BookAddedNotification;
use Illuminate\Support\Facades\Mail;

class BookAddedNotificationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Mail::fake();
        $this->mail = new BookAddedNotification();
    }

    public function testCorrectAttributes()
    {
        $this->mail->build();
        $this->assertEquals('no-reply@example.com', $this->mail->from[0]['address']);
        $this->assertEquals('admin@example.com', $this->mail->to[0]['address']);
        $this->assertEquals('Book added!', $this->mail->subject);
    }
}