<?php

/**
 * PERIOD
 * this class is one period in the timetable
 * its atributes are; subject, start time, end time, day, classroom and teacher.
 * functions are exporting as an array
 */

class Period {
    //properties
    public $subject;
    public $startTime;
    public $endTime;
    public $period;
    public $day; // day 1-10 with the 14day timetable
    public $classroom;
    public $teacher;
    
    //methods
    public function __construct($subject, $startTime, $endTime, $period, $day, $classroom, $teacher) {
        $this->subject = $subject;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->period = $period;
        $this->day = $day;
        $this->classroom = $classroom;
        $this->teacher = $teacher;
    }

    // asArray() : exports the class properties as an array
    public function asArray() {
        $array = [
            $this->subject,
            $this->startTime,
            $this->endTime,
            $this->period,
            $this->day,
            $this->classroom,
            $this->teacher
        ];
        return $array;
    }
}