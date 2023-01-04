<?php
class LoginPage extends IrmisFramework {
    public $template = 'tpls/form';
    public function render() {
        return [
            "header"=>'Login page'
        ];
    }
}