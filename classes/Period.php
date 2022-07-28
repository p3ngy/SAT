<?php

/**
 * PERIOD
 * this class is one period in the timetable
 * its atributes are; subject, start time, end time, day, classroom and teacher.
 * functions are exporting as an array
 */

class Period {
    //properties
    public $subject;    // 0
    public $startTime;  // 1
    public $endTime;    // 2
    public $period;     // 3
    public $day;        // 4 : day 1-10 with the 14day timetable
    public $classroom;  // 5
    public $teacher;    // 6
    
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