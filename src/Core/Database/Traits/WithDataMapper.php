<?php 

namespace App\Core\Database\Traits;

use PDOException;

trait WithDataMapper 
{    
    public function rows(string $table): array|string
    {
        try {
            $sql = "SELECT * FROM `{$table}`";

            $this->db = $this->connect();
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function totalCount(string $table)
    {
        try {
            $sql = "SELECT COUNT(id) as total from `{$table}`";
            
            $this->db = $this->connect();
            $stmt = $this->db->prepare($sql);

            $stmt->execute();
            $row = $stmt->fetch();

            return $row->total;
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function findById(string | int $id, string $table): object|bool
    {
        try {
            $sql = "SELECT * FROM `{$table}` WHERE id=:id";

            // connect
            $this->db = $this->connect();
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id" => $id]);

            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // create or update
    public function save(object $model, string $table) :int|string
    {
        try {
            // if id property on $model object is already assigned, 
            // update
            // otherwise insert or create
            if (isset($model->id) || false) {
                $sql = $this->updateQueryByTable($table);

                // connect
                $this->db = $this->connect();
                $stmt = $this->db->prepare($sql);

                // dd($this->updateDataToExecute($model, $table));
                
                $stmt->execute(
                    $this->updateDataToExecute($model, $table)
                );

                return $model->id;
                
            } else {
                // insert
                $sql = $this->createQueryByTable($table);

                // connect 
                $this->db = $this->connect();
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    $this->createDataToExecute($model, $table)
                );
                
                return (int) $this->db->lastInsertId();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // delete
    public function remove(object $model, string $table): bool|string
    {
        try {
            $sql = "DELETE FROM `{$table}` WHERE id=:id";

            $this->db = $this->connect();
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $model->id]);

            return true;
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    // create sql according to table
    private function createQueryByTable(string $table)
    {
        return match($table) {
            'users' => "INSERT INTO `{$table}`
                                    (name, email, password, address, phone, role_id, created_at, updated_at) 
                                    VALUES(:name, :email, :password, :address, :phone, :role_id, NOW(), NOW())",
        };
    }

    // data to execute params when create record
    private function createDataToExecute(object $model, string $table)
    {
        return match($table) {
            'users' => [
                ':name' => $model->name,
                ':email' => $model->email,
                ':password' => $model->password,
                ':address' => $model->address,
                ':phone' => $model->phone,
                ':role_id' => $model?->role_id ?? 1,
            ],
        };
    }

    // update sql according to table
    private function updateQueryByTable(string $table)
    {
        return match ($table) {
            'users' => "UPDATE `{$table}`
                                SET name=:name, email=:email, password=:password, address=:address, phone=:phone, role_id=:role_id, updated_at=NOW()
                                WHERE :id=id
                                    ",
        };
    }

    // data to execute params when update record
    private function updateDataToExecute(object $model, string $table)
    {
        return match($table) {
            'users' => [
                ':id' => $model->id,
                ':name' => $model->name,
                ':email' => $model->email,
                ':password' => $model->password,
                ':address' => $model->address,
                ':phone' => $model->phone,
                ":role_id" => $model->roleId,
            ],
        };
    }
}