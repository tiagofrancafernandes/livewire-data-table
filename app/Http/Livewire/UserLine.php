<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserLine extends Component
{
    public $user;
    public $edit = false;

    public $name;
    public $email;
    public $originalName;
    public $originalEmail;    

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name'  => 'required|min:3',
            'email' => 'required|email',
        ]);
    }

    public function mount($user)
    {
        $this->user             = $user;
        $this->originalName     = $user->name;
        $this->originalEmail    = $user->email;

        $this->init($user);
    }

    public function render()
    {
        return view('livewire.user-line');
    }

    private function init($user)
    {
        $this->user     = $user;

        $this->name     = $user->name ?? $this->originalName;
        $this->email    = $user->email ?? $this->originalEmail;
    }

    public function editUser()
    {
        $this->edit = $this->edit ? false : true;
    }

    public function restoreOriginalValues()
    {
        $this->name     = $this->originalName;
        $this->email    = $this->originalEmail;        
    }

    public function cancelEditUser()
    {
        if($this->edit)
        {
            $this->edit = false;
            $this->restoreOriginalValues();
        }
    }

    public function saveEditedUser()
    {
        $this->validate([
            'name'  => 'required|min:3',
            'email' => 'required|email',
        ]);

        $new_data = [];

        if($this->email != $this->originalEmail)
            $new_data = array_merge($new_data, ['email' =>  $this->email]);

        if($this->name != $this->originalName)
            $new_data = array_merge($new_data, ['name' =>  $this->name]);

        if(count($new_data) > 0)
        {
            $user_was_updated = $this->user->update($new_data);

            if($user_was_updated)
            {
                $this->init($this->user);
            }

        }

        $this->cancelEditUser();
    }
}
