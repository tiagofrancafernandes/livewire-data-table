<?php

namespace App\Http\Livewire;

use App\Models\User;

use Schema;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderDirection = 'asc';

    public function updatingSearch() //https://laravel-livewire.com/docs/2.x/pagination
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::search($this->search)
                ->orderBy($this->orderBy, $this->orderDirection)
                ->paginate($this->perPage),
        ]);
    }

    public function changeOrderBy($orderBy)
    {
        $accept_columns = Schema::getColumnListing('users');

        if(in_array($orderBy, $accept_columns) && $orderBy === $this->orderBy)
            $this->invertOrderDirection();

        if(in_array($orderBy, $accept_columns))
            $this->orderBy = $orderBy;
    }

    public function invertOrderDirection()
    {
        $this->orderDirection = $this->orderDirection == 'desc' ? 'asc' : 'desc';
    }
}
