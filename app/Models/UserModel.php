<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['username', 'password', 'full_name'];
    protected $useTimestamps = false;
    protected $returnType    = 'array';

    public function findByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }
}
