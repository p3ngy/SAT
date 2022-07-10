<?php 

/**
 * CALENDAR
 * this class handles the creation and output of the calendar
 */
class Calendar {

    public $activeYear, $activeMonth, $activeDay;
    public $events = [];

    public function __construct($date = null) {
        $this->activeYear = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->activeMonth = $date != null ? date('m', strtotime($date)) : date('m');
        $this->activeDay = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function addEvent($name, $date, $duration = 1, $category, $notes, $type) {
        $this->events[] = [$name, $date, $duration, $category, $notes, $type];
    }
}
?>