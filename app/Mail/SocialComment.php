<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\SocialiteUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SocialComment extends Mailable
{
    use Queueable, SerializesModels;

    protected $comment;
    protected $socialUser;
    protected $articleURL;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, $subject)
    {
        $this->subject('Hi '.$subject);
        $this->comment = $comment;
        $this->socialUser = SocialiteUser::where('openid', $this->comment->socialite_user_id)->first();
        $this->articleURL = $this->comment->article->url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.social.comment')->with([
            'markdown' => $this->comment->markdown,
            'user' => $this->socialUser->nick_name,
            'articleURL' => $this->articleURL
        ]);
    }
}
