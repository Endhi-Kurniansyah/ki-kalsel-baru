<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class FrontendLayout extends Component
{
    public $page_title;

    /**
     * Buat instance komponen baru.
     */
    public function __construct($pageTitle = 'Komisi Informasi Prov. Kalsel')
    {
        $this->page_title = $pageTitle;
    }

    /**
     * Dapatkan view / konten yang merepresentasikan komponen.
     */
    public function render(): View
    {
        return view('frontend.layouts.app');
    }
}
