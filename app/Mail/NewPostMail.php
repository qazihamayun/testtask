<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\WebsitePost;
use Illuminate\Support\Facades\Log;

class NewPostMail extends Mailable
{
    use Queueable, SerializesModels;

    public $websitePost;
    /**
     * Create a new message instance.
     */
    public function __construct($websitePost)
    {
        $this->websitePost = $websitePost;
    }

    public function build()
    {
        return $this->view('emails.new_post')
            ->with([
                'title' => $this->websitePost->title,
                'description' => $this->websitePost->description,
            ]);
    }

}
