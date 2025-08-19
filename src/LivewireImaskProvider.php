<?php

namespace LaraPack\LivewireImask;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireImaskProvider extends ServiceProvider
{
    public function boot()
    {
        // Daftarkan Livewire component
        Livewire::component('lara-pack.livewire-imask', Input::class);

        // Muat file view dari folder "resources/views"
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lara-pack.livewire-imask');
    }
}