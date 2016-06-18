<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class CubeSumationBase extends Model
{
  // Relations
  public function user() {
    return $this->belongsTo('\App\User');
  }
  /**
   * Get the cube_sumation_iterations for the CubeSumationBase.
   */
  public function cube_sumation_iterations() {
    return $this->hasMany('App\CubeSumationIteration');
  }

  public function CanBeRun() {
    $flag = true;
    if ($this->iterations_number == $this->iteration_to_be_do) {
      foreach ($this->cube_sumation_iterations()->get() as $key => $iteration) {
        if ($iteration->m != $iteration->commands_to_be_do){
          $flag = false;
          break;
        }
      }
      if ($flag) {
        return true;
      }
    }
    return false;
  }

  public function Run() {
    $output = "";

    if ($this->CanBeRun()){
      $querys = [];
      foreach ($this->cube_sumation_iterations()->get() as $key => $iteration) {
        // Reset Cube
        $iteration->array_cube = $iteration->getEmptyCube($iteration->n);
        $iteration->save();
        $output .= "{$iteration->n} {$iteration->m}\n";

        foreach ($iteration->cube_sumation_commands()->get() as $key => $command) {
          $parameters = implode(', ', $command->params);
          $output .= "command:> {$command->command} {$parameters}\n";
          $acum = $command->runCommand();
          if ( !is_null($acum)){
            array_push($querys, $acum);
          }
        }

      }
      
      $output .= "Result Querys:\n";
      $out = implode("\n", $querys);
      $output .= "{$out}";  
    }
    
    return $output;
  }

  public static function Execute($id) {
    return CubeSumationBase::find($id)->Run();
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
