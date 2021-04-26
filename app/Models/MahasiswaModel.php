<?php

namespace App\Models;
use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = "mahasiswa";
    protected $primaryKey = "id";   
    protected $allowedFields = ["stambuk", "nama", "kelas"];
    protected $useTimestamps  = false;
}




?>