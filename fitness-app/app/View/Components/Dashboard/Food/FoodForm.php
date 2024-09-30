<?php

namespace App\View\Components\Dashboard\Food;

use App\Models\Food;
use App\Models\FoodType;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FoodForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $routeUrl,
        public string $method,
        public ?Food $food = null,)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.food.food-form');
    }

    public function foodTypes(): Collection {
        return FoodType::all();
    }
}
