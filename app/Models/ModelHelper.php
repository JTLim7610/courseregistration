<?php

namespace App\Models;

trait ModelHelper 
{
    # Funtion to get Model meta 
    public function getMeta($key = null)
    {
        return $this->getJSON('meta', $key);
    }
}
