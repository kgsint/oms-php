<?php 

namespace App\Http\Middlewares;

use App\Contracts\MiddlewareInterface;

class RedirectIfGuest implements MiddlewareInterface
{
    public function handle()
    {
        if(empty($_SESSION['user'])) {
            redirect('/login');
            exit;
        }
    }
}