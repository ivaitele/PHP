<?php
class LoginPage extends IrmisFramework {
    public $template = __DIR__.'/LoginPage';

    public function render() {
        print_r($this->user);
        return [
            "header" => 'Login page'
        ];
    }
}