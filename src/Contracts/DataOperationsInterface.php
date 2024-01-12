<?php

namespace App\Contracts;

interface DataOperationsInterface
{
    /**
     * total records by table
     */
    public function rows(string $table, $orderBy = 'DESC', $limit = null): array|string;

    /**
     * total count by table
     */
    public function totalCount(string $table): int|string;

    /**
     * search records
     */
    public function search(string $search, string $table, array $fields): array|string;

    /**
     * get the record by id
     */
    public function findById(string|int $id, string $table): object|bool;

    /**
     * get the record by column name
     */
    public function findByField(string | int $field, string $value, string $table): object|bool;

    /**
     * insert or update record
     */
    public function save(object $model, string $table) :int|string;

    /**
     * delete record from the table
     */
    public function remove(object $model, string $table): bool|string;
}