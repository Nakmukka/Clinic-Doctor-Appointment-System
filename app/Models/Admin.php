<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Model
{
    use HasFactory;
}
class Admin extends Authenticatable
{
    protected $fillable = ['name','password'];
    
    // Define any relationships or methods for the Admin model as needed
}