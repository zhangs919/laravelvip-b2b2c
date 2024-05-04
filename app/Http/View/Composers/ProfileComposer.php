<?php


namespace App\Http\View\Composers;


use App\Repositories\UserRepository;
use Illuminate\View\View;

class ProfileComposer
{

    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $view->with('count', $this->users->count());
    }
}