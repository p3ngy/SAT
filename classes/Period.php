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
    public function __construct($data) {
        $this->subject = $data["subject"];
        $this->startTime = $data["startTime"];
        $this->endTime = $data["endTime"];
        $this->period = $data["period"];
        $this->day = $data["day"];
        $this->classroom = $data["classroom"];
        $this->teacher = $data["teacher"];
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