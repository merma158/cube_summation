<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  /**
   * Get the cube_sumation_bases for the user.
   */
  public function cube_sumation_bases() {
    return $this->hasMany('App\CubeSumationBase');
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 'name', 'email', 'password'];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [ 'password', 'remember_token'];
  

  public function Cubes() {
    return $this->cube_sumation_bases()->count();
  }

  public function Iterations() {
    $counter = 0;
    foreach ($this->cube_sumation_bases()->get() as $key => $cube) {
      $counter += $cube->cube_sumation_iterations()->count();
    }
    return $counter;
  }
}
