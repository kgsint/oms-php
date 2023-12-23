<?php
namespace App\Repositories;

use App\Core\Database\Database;
use App\Models\User;

class UserRepository 
{
    public function __construct(
        private Database $db,
    ){}

    public function getAll(): array|string
    {
        return $this->db->rows('users');
    }

    public function getCount()
    {
        return $this->db->totalCount('users');
    }

    public function find(string|int $id): User|array
    {
        $data =  $this->db->findById($id, 'users');

        // if not found, return empty array
        if(! $data) {
            return [];
        }

        $user = new User;
        $user->id = $data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        $user->phone = $data->phone;
        $user->address = $data->address;
        $user->roleId = $data->role_id;
        $user->createdAt = mysqlTimestampToDateTime($data->created_at);
        $user->updatedAt = mysqlTimestampToDateTime($data->updated_at);

        return $user;
    }

    public function save(User $user): int|string
    {
        return $this->db->save($user, 'users');
    }

    public function delete(User $user): bool|string
    {
        return $this->db->remove($user, 'users');
    }
}