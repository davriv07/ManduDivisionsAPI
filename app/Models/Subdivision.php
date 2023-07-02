<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
  protected $table = 'subdivisions_relations';
  protected $primaryKey = 'id';
  public $incrementing = true;

  // * Allow massive creating or usage of create method
  protected $fillable = ['id_division_parent', 'id_division_sub'];
  use HasFactory;
}
