<?php

namespace App\Core\Database\Factories;

use App\Core\Database\MySQL;
use App\Models\User;

class UserFactory 
{
    private MySQL $db;

    public function __construct()
    {
        $this->db = new MySQL;
    }

    public function create(array $data)
    {
        $user = new User;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->roleId = $data['role_id'];

        $this->db->save($user, 'users');

    }
}