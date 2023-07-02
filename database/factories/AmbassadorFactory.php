<?php

namespace Database\Factories;

use App\Models\Ambassador;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
// datefmt_set_timezone('America/Lima');

class AmbassadorFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Ambassador::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    try{
      return [
        'name' => $this->faker->name(),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ];
    }
    catch (Exception $e) {
      Throw $e;
    }
  }
}
