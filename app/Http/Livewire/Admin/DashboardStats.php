<?php

namespace App\Http\Livewire\Admin;

use CoderStudios\Libraries\OrganisationsLibrary;
use CoderStudios\Libraries\UsersLibrary;
use CoderStudios\Models\EmailsModel;
use Livewire\Component;

class DashboardStats extends Component
{
    public function mount(EmailsModel $emails, UsersLibrary $users, OrganisationsLibrary $organisations)
    {
        $this->subscribers_count = $emails->where('valid', 1)->count();
        $this->trial_users = $organisations->where('is_trial', 1)->where('licence_ends_at', '>=', now())->count();
        $this->expired_trial_users = $organisations->where('is_trial', 1)->where('licence_ends_at', '<=', now())->count();
        $this->paid_users = $organisations->where('is_paid', 1)->count();
    }
}
