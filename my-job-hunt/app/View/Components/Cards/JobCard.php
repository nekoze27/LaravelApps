<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Job;

class JobCard extends Component
{
    public Job $job;
    public string $color;

    /**
     * Create a new component instance.
     */
    public function __construct(Job $job, string $color)
    {
        $this->job = $job;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.job-card');
    }
}
