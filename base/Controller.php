<?php

namespace rk\base;
use rk\base\View;
class Controller extends View
{
    function pageNotFound(){
        return 'Page not found';
    }
}