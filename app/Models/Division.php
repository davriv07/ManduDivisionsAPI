<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  protected $table = 'divisions';
  protected $primaryKey = 'id';
  public $incrementing = true;

  // * Allow massive creating or usage of create method
  protected $fillable = ['division'];
  use HasFactory;
}
