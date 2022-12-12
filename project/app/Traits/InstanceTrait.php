<?php

namespace App\Traits;

trait InstanceTrait {
    
    /**
     * Get class as static.
     * @staticvar type $self
     * @return \self
     */
    public static function instance() : self {
        static $self = null;
        if($self === null) {
            $self = new self();
        }
        return $self;
    }
}
