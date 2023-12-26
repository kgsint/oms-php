<?php

namespace App\Contracts;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll(): array;

    public function search(string $search): array;

    public function find(string|int $id): ?Category;

    /**
     * @return $id of the currently created or updated category
     */
    public function save(Category $category): int;

    public function delete(Category $category);
}