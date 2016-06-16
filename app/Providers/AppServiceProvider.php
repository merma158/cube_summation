<?php

namespace App\Providers;

use App\CubeSumationBase;
use App\CubeSumationIteration;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
    * Bootstrap any application services.
    *
    * @return void
    */
  public function boot()
  {
    //
    CubeSumationBase::creating(function ($cube_sumation_base) {
      if (CubeSumationBase::getOpenCount() > 0) {
        return false;
      }
    });

    CubeSumationIteration::creating(function ($cube_sumation_iteration) {
      // check if exist CubeSumation => OPEN => OnlyOne
      if (CubeSumationBase::checkExistsOpenCubeSummation()) {
        $cube = CubeSumationBase::getOpenCubeSummation();
        if ($cube->iteration_to_be_do < $cube->iterations_number) {

          $cube_sumation_iteration->cube_sumation_base_id = $cube->id;        
          $cube->iteration_to_be_do = intval($cube->iteration_to_be_do) + 1;
          // close Cube if last iteration
          if ($cube->iteration_to_be_do == $cube->iterations_number) {
            $cube->status = "close";
          }

          $cube->save();
        } else {
          // Do not permit any more iteration for current cube
          return false;
        }
      }
      
    });
  }
  /**
    * Register any application services.
    *
    * @return void
    */
  public function register()
  {
    //
  }
}
