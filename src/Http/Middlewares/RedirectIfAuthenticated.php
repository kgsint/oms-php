<?php 

namespace App\Http\Middlewares;

use App\Contracts\MiddlewareInterface;

class RedirectIfAuthenticated implements MiddlewareInterface
{
    public function handle()
    {
        if(isset($_SESSION['user'])) {
            redirect('/');
        }
    }
}