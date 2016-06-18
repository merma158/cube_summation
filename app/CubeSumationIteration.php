<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CubeSumationIteration extends Model
{
  // Relations
  public function cube_sumation_base() {
    return $this->belongsTo('\App\CubeSumationBase');
  }

  public function cube_sumation_commands() {
    return $this->hasMany('App\CubeSumationCommand');
  }
  /*
    Define Scopes
  */
  public function scopeIterationsByCube($query, $cube_id) {
    return $query->where("cube_sumation_base_id","=", $cube_id);
  }
  /**
  * The attributes that should be casted to native types.
  *
  * @var array
  */
  protected $casts = [
    'array_cube' => 'array',
  ];

  public function getEmptyCube($n) {
    return array_fill(0, $n, 
            array_fill(0, $n, 
              array_fill(0, $n, 0)));
  }
}
