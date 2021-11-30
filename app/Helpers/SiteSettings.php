<?php

use App\Models\SiteSetting;

function siteSettings(){
    $settings = SiteSetting::first();
    return $settings;
}