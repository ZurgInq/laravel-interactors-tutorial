<?php

namespace Lib\Bookshelf\Mail;
 
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookAddedNotification extends Mailable 
{
    use SerializesModels;
 
    public function build() {
        $this->from('no-reply@example.com')
            ->to('admin@example.com')
            ->subject('Book added!');
            
        return $this->view('emails.book_added_notification');
    }
}