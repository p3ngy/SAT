<?php

class Period {
    //properties
    public $subject;
    public $startTime;
    public $endTime;
    public $day; // day 1-10 with the 14day timetable
    public $classroom;
    public $teacher;
    
    //methods
    public function __construct($subject, $startTime, $endTime, $day, $classroom, $teacher) {
        $this->subject = $subject;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->day = $day;
        $this->classroom = $classroom;
        $this->teacher = $teacher;
    }

    public function asArray() {
        $array = [
            $this->subject,
            $this->startTime,
            $this->endTime,
            $this->day,
            $this->classroom,
            $this->teacher
        ];
        return $array;
    }
}