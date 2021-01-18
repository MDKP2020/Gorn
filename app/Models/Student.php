<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;

  protected $table = 'students';

  public $timestamps = false;

  public $incrementing = false;

  public function group(){
    return $this->morphTo();
  }
  
}