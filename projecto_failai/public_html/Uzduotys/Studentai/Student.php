<?php

namespace Studentai;

use Studentai\Grupe;

class Student {
     public string $name;
     private string $pavarde;
     private int $ak;
     public Grupe $grupe;

    public function __construct(string $name, string $pavarde, int $ak, Grupe $grupe) {
        $this->name = $name;
        $this->pavarde = $pavarde;
        $this->ak = $ak;
        $this->grupe = $grupe;

        $grupe->addStudent($this);
    }

    function getInfo() {
        return $this->name. ' ' . $this->ak . ' - ' . $this->getGender() .' '. $this->grupe->code;
    }

    function isMale() {
        return ($this->ak.'')[0] === '3';
    }

    function isFemale() {
        return !$this->isMale();
    }
    function getGender() {
        return $this->isMale() ? 'Vyras': 'Moteris';
    }

    function getAge() {
        return $this->ak % 10000000000;
    }


}