<?php 

namespace App\Core;

use App\Core\Database\Database;
use App\Models\User;
use App\Repositories\UserRepository;

class Auth 
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database);
    }

    // check authenticated or not
    public static function check(): bool
    {
        if(empty($_SESSION['user'])) {
            return false;
        }

        return true;
    }

    // get currently authenticated user model
    public function user(): ?User
    {
        if(! Auth::check()) {
            return null;
        }

        return $this->userRepo->find($_SESSION['user']['id']);
    }

    public function __call($name, $arguments)
    {
        call_user_func($name, [$arguments]);
    }
}