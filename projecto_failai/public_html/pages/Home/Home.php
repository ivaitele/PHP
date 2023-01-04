<?php

namespace IrmisPage;

use IrmisPage\IrmisFramework;

class Home extends IrmisFramework {
    public $template = __DIR__.'/Home';

    public function render() {
        return [
            "header" => 'Welcome Home!!'
        ];
    }
}