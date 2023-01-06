<?php

namespace Appsas;

abstract class AbstractRender
{
    protected $output;
    public $env = 'dev';

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function render()
    {
        $this->output->store($this->getContent());
    }

    public function debug() {
        if ($this->env === 'dev' && isset($this->errorArr) && count($this->errorArr)) {
            $errorStr = '';
            foreach ($this->errorArr as $key => $value) {
                $errorStr = $errorStr. '<li>{{'.$key.'}} => ('.$value.') nerastas template'.'</li>';
            }
            $this->output->store('<pre class="debug-error">'.$errorStr.'</pre>');
        }
    }
    abstract protected function getContent();
}