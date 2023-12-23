<?php 

namespace App\Models;

use DateTime;

class User 
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $address;
    public string $phone;
    public string $roleId;
    public DateTime $createdAt;
    public DateTime $updatedAt;

}