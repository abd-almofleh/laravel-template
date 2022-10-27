<?php

namespace App\View\Components\Frontend\Layouts;

use App\Models\HorseType;
use Illuminate\View\Component;

class Footer extends Component
{
  public $horseTypes;

  /**
   * Create a new component instance.
   */
  public function __construct()
  {
    $this->horseTypes = HorseType::limit(5)->get();
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render(): \Illuminate\Contracts\View\View | \Closure | string
  {
    return view('components.frontend.layouts.footer');
  }
}
