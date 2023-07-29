<?php

namespace App\Http\Livewire;

use CoderStudios\Mailer\VerifyEmail;
use CoderStudios\Models\EmailsModel;
use Livewire\Component;

class EmailList extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function submit()
    {
        $this->validate();
        $email = strtolower(trim($this->email));
        $hash = EmailsModel::first()->generateHash($this->email);
        if (!EmailsModel::where('email', $this->email)->count()) {
            EmailsModel::create([
                'email' => $email,
                'hash' => $hash,
            ]);
        } else {
            $record = EmailsModel::where('email', $this->email)->first();
            if ($record) {
                $hash = $record->hash;
            }
        }
        \Mail::to($email)
            ->send(new VerifyEmail(['email' => $email, 'hash' => $hash]))
        ;
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.email-list');
    }
}
