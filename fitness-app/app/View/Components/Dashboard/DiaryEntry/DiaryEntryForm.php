<?php

namespace App\View\Components\Dashboard\DiaryEntry;

use App\Models\DiaryEntry;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DiaryEntryForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $routeUrl,
        public string $method,
        public ?DiaryEntry  $diaryEntry = null,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.diary-entry.diary-entry-form');
    }
}
