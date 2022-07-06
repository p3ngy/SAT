<?php

class Event {
    // properties
    public $name;
    public $startDateTime;
    public $endDateTime;
    public $category;
    public $notes;

    public function __construct($name, $startDateTime, $endDateTime, $category, $notes) {
        $this->name = $name;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
        $this->category = $category;
        $this->notes = $notes;
    }

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