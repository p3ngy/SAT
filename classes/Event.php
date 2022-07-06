<?php

/**
 * EVENT
 * this class contains one calendar event.
 * it has the properties; name, start datetime, end datetime, calegory and notes.
 * its functions are exporting the class as an array.
 */

class Event {
    // properties
    public $name;
    public $startDateTime;
    public $endDateTime;
    public $category;
    public $notes;

    // methods
    public function __construct($name, $startDateTime, $endDateTime, $category, $notes) {
        $this->name = $name;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
        $this->category = $category;
        $this->notes = $notes;
    }

    // asArray() : exports the class properties as an array
    public function asArray() {
        $array = [
            $this->name,
            $this->startDateTime,
            $this->endDateTime,
            $this->category,
            $this->notes
        ];
        return $array;
    }
}