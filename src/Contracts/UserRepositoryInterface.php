<?php 

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    // get all user records
    public function getAll(): array|string;

    // get total user count
    public function getCount(): int;

    // search user record
    public function search(string $search);

    // fetch user by record
    public function find(string|int $id): ?User;

    // fetch user by email
    public function findByEmail(string $email): ?User;

    // create or update
    public function save(User $user): int|string;

    // delete user record
    public function delete(User $user): bool|string;
}