<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Core\Database\Database;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private Database $db,
    ){}

    public function getAll(): array|string
    {
        return $this->db->rows('users');
    }

    public function getCount(): int
    {
        return $this->db->totalCount('users');
    }

    public function search(string $search)
    {
        return $this->db->search($search, 'users', ['name', 'email']);
    }

    public function find(string|int $id): ?User
    {
        $data =  $this->db->findById($id, 'users');

        // if not found, return null
        if(! $data) {
            return null;
        }

        // transform to User model object
        $user = $this->setUserModel($data);

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        $data =  $this->db->findByField('email',$email, 'users');

        // if not found, return null
        if(! $data) {
            return null;
        }

        // transform to User model object
        $user = $this->setUserModel($data);

        return $user;
    }

    /**
     * @return $id of the currently created or updated user record
     */
    public function save(User $user): int
    {
        return $this->db->save($user, 'users');
    }

    public function delete(User $user): bool|string
    {
        return $this->db->remove($user, 'users');
    }

    private function setUserModel(object $data): User
    {
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
}