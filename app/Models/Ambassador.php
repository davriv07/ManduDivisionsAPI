<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
  
  protected $table = 'ambassadors';
  protected $primaryKey = 'id';
  public $incrementing = true;

  // * Allow massive creating or usage of create method
  protected $fillable = ['name'];

  use HasFactory;
}
