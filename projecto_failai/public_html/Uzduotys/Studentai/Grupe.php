<?php

namespace Studentai;
class Grupe
{
    public string $name;
    public string $code;
    private string $adresas;
    private $students = array();

    public function __construct(string $name, string $code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    function addStudent($student)
    {
        $this->students[] = $student;
    }

    function getStudents()
    {
        return $this->students;
    }

    function getStrudentCount()
    {
        return count($this->students);
    }

    function getTimeCode()
    {
        return $this->code[-1];
    }
}