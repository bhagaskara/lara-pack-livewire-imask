<?php

namespace LaraPack\LivewireImask;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Input extends Component
{
    #[Modelable]
    public string | null $value = '';

    #[Locked]
    public string $inputId;
    public string $class = '';
    public string $mask = "Number";
    public string $thousandsSeparator = '.';
    public string $radix = ',';
    public int $debounceTime = 500;
    public int $scale = 3;
    public $disabled = false;

    public function mount(): void
    {
        $this->inputId = 'imask-input-' . Str::uuid()->toString();
    }

    public function render(): View
    {
        return view('lara-pack.livewire-imask::input');
    }
}
