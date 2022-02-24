<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $count;
    protected $posts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($count, $posts)
    {
        $this->count = $count;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $count = $this->count;
        $posts = $this->posts;
        
        return $this->view('admin.pages.dailyReport', compact('count', 'posts'));
    }
}
