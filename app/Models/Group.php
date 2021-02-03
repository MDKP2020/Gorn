<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  use HasFactory;

  protected $table = 'groups';

  protected $keyType = 'string';

  public $timestamps = false;

  public $incrementing = false;

  public function group(){
    return $this->morphMany(Student::class, 'group');
  }

  public function getAllAttributes()
{
    $columns = $this->getFillable();
    $attributes = $this->getAttributes();

    foreach ($columns as $column)
    {
        if (!array_key_exists($column, $attributes))
        {
            $attributes[$column] = null;
        }
    }
    return $attributes;
}
}