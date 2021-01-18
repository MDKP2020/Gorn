<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;

  protected $table = 'groups';

  protected $keyType = 'string';

  public $timestamps = false;

  public $incrementing = false;

  public function group(){
    return $this->morphMany(Student::class, 'group');
  }
}