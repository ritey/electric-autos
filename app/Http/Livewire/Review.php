<?php

namespace App\Http\Livewire;

use CoderStudios\Mailer\BlankMailer;
use CoderStudios\Mailer\PlainMailer;
use CoderStudios\Models\ReviewsModel;
use Livewire\Component;

class Review extends Component
{
    public $email;
    public $message;
    public $rating;

    protected $rules = [
        'email' => 'required|email',
        'message' => 'nullable',
        'rating' => 'numeric|nullable',
    ];

    public function mount()
    {
        $this->email = \Auth::user()->email ?? null;
    }

    public function submit()
    {
        $this->validate();

        $email = strtolower(trim($this->email));
        $hash = substr(md5(time().strtolower(trim($this->email))), 0, 10);

        if ($this->message || $this->rating) {
            if (!ReviewsModel::where('email', $this->email)->count()) {
                ReviewsModel::create([
                    'user_id' => \Auth::user()->id,
                    'email' => $email,
                    'message' => $this->message,
                    'rating' => $this->rating,
                ]);
            } else {
                $record = ReviewsModel::where('email', $this->email)->first();
                if ($record) {
                    $hash = $record->hash;
                }
            }

            \Mail::to($email)
                ->send(new PlainMailer([
                    'email' => $email,
                    'hash' => $hash,
                    'subject' => 'Thanks for leaving a review on '.config('app.name'),
                    'html_body' => view('mailers.email.review-thankyou')->render(),
                ]))
            ;
            \Mail::to('dave@coderstudios.com')
                ->send(new BlankMailer([
                    'subject' => 'A new review has been left by '.$email,
                    'email' => 'dave@coderstudios.com',
                    'body_html' => 'The review is:<br><br>'.$this->message,
                    'hash' => $hash,
                ]))
            ;

            $this->emitTo('toast', 'show', 'Review received, thank you');
        }
    }

    public function render()
    {
        return view('livewire.review');
    }
}
