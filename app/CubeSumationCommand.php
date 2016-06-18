<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CubeSumationCommand extends Model
{
  // Relations
  public function cube_sumation_iteration() {
    return $this->belongsTo('\App\CubeSumationIteration');
  }
  /*
    Define Scopes
  */
  public function scopeCommandsByIteration($query, $iteration_id) {
    return $query->where("cube_sumation_iteration_id", "=", $iteration_id);
  }
  /**
  * The attributes that should be casted to native types.
  *
  * @var array
  */
  protected $casts = [
    'params' => 'array',
  ];

  public function runCommand() {
    $iteration = $this->cube_sumation_iteration()->first();

      switch (strtolower($this->command)) {
        case 'update':  

          $x = intval($this->params[0] - 1);
          $y = intval($this->params[1] - 1);
          $z = intval($this->params[2] - 1);
          $w = intval($this->params[3]);

          $aux = $iteration->array_cube;
          $aux[$x][$y][$z] = $w;

          $iteration->array_cube = $aux;
          $iteration->save();
        break;
        case 'query':  
          $acum = 0;

          $x1 = intval($this->params[0] - 1);
          $y1 = intval($this->params[1] - 1);
          $z1 = intval($this->params[2] - 1);
          # ==================================================
          $x2 = intval($this->params[3] - 1);
          $y2 = intval($this->params[4] - 1);
          $z2 = intval($this->params[5] - 1);

          for ($i=$x1; $i < $x2; $i++) { 
            for ($j=$y1; $j < $y2; $j++) { 
              for ($k=$z1; $k < $z2; $k++) { 
                $acum += intval($iteration->array_cube[$i][$j][$k]);
              }
            }
          }
        return $acum;
        break;
        default: break;
      }
      return null;
  }
}
