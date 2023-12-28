<?php 

namespace App\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getAll(): array;

    public function getWithProduct(): array|string;

    public function getCount(): int;

    public function find(string|int $id): Order|null|string;

    /**
     * @return $id of the currently created or updated product record
     */
    public function save(Order $order): int;

    public function delete(Order $order);
}