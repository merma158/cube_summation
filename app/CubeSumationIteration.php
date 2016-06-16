<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CubeSumationIteration extends Model
{
  //
  public function cube_sumation_base() {
    return $this->belongsTo('\App\CubeSumationBase');
  }
  /*
    Define Scopes
  */
  public function scopeIterationsByCube($query, $cube_id) {
    return $query->where("cube_sumation_base_id","=", $cube_id);
  }
}
