<?php

namespace App\Providers;

use App\CubeSumationBase;
use App\CubeSumationIteration;
use App\CubeSumationCommand;
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

          $array_size = intval($cube_sumation_iteration->n);

          $cube_3d = $cube_sumation_iteration->getEmptyCube($array_size);

          $cube_sumation_iteration->array_cube = $cube_3d;
          $cube_sumation_iteration->cube_sumation_base_id = $cube->id;
          $cube->iteration_to_be_do += 1; // intval($cube->iteration_to_be_do) +
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

//    CubeSumationIteration::created(function ($cube_sumation_iteration) {
//      $cube = $cube_sumation_iteration->cube_sumation_base();
//    });

    CubeSumationCommand::creating(function ($cube_sumation_command) {
      $iteration = $cube_sumation_command->cube_sumation_iteration()->first();
      if ($iteration->commands_to_be_do < $iteration->m) {

        $iteration->commands_to_be_do += 1;
        $iteration->save();
      } else {
        // Do not permit any more command for current iteration
        return false;
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
