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
    CubeSumationBase::saving(function ($cube_sumation_base) {
      if (CubeSumationBase::getOpenCount() > 0) {
        return false;
      }
    });
    CubeSumationIteration::creating(function ($cube_sumation_iteration) {
      // check if exist CubeSumation => OPEN => OnlyOne
      if (CubeSumationBase::checkExistsOpenCubeSummation()) {
        $cube_sumation_iteration->cube_sumation_base_id = CubeSumationBase::getOpenCubeSummation()->id;
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
