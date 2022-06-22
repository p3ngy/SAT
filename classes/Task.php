<?php

class Task {
    // properties
    public $name;
    public $dueDate;
    public $priority;
    public $subject;
    public $notes;
    
    // methods
    public function __construct($name, $dueDate, $priority, $subject, $notes) {
        $this->name = $name;
        $this->dueDate = $dueDate;
        $this->priority = $priority;
        $this->subject = $subject;
        $this->notes = $notes;
    }

    public function asArray() {
        $array = [
            $this->name,
            $this->dueDate,
            $this->priority,
            $this->subject,
            $this->notes
        ];
        return $array;
    }
}