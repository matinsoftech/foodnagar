<?php

namespace App\Http\Livewire\Website;

use App\Models\Banner;


class WelcomeLivewire extends WebsiteBaseLivewireComponent
{

    public function render()
    {
        $banners=Banner::all();
        // dd($banners);
        return view('livewire.website.welcome',compact('banners'))->layout('layouts.website');
    }
}
