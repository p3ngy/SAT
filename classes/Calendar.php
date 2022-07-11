<?php 

/**
 * CALENDAR
 * this class handles the calendar
 * attributes include the active year, month and day (active being what is displayed, not the current time)
 * methods are __construct,  add event and remove event.
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

    public function removeEvent($eventIndex) {
        unset($this->events[$eventIndex]);
    }
}
?>