<?php 

/**
 * CALENDAR
 * this class handles the creation and output of the calendar
 */
class Calendar {

    public $active_year, $active_month, $active_day;
    public $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function addEvent($name, $date, $duration = 1, $category) {
        $this->events[] = [$name, $date, $duration, $category];
    }
}
?>