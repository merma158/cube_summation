<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class CubeSumationBase extends Model
{
  //
  public function user() {
    return $this->belongsTo('\App\User');
  }

  /**
   * Get the cube_sumation_iterations for the CubeSumationBase.
   */
  public function cube_sumation_iterations() {
    return $this->hasMany('App\CubeSumationIteration');
  }

  public static function getOpenCount() {
    if (Auth::user()) {
      return CubeSumationBase::where("status", "=", "open")
                             ->where("user_id", "=", Auth::user()->id)
                             ->count();
    }
    return 0;
  }

  public static function checkExistsOpenCubeSummation() {
    return (CubeSumationBase::getOpenCount() == 1);
  }

  public static function getOpenCubeSummation() {
    if (Auth::user()) {
      return CubeSumationBase::where("status", "=", "open")
                             ->where("user_id", "=", Auth::user()->id)
                             ->first(); 
    }
    return null;
  }
}
