<?php
class Dwarf extends Character {
    private $magic; 
    
    public function __construct (
                                string $name,
                                int $magic,
                                int $size=0,
                                int $strength=240
                                ) {
        /* Wird ein Konstruktor überschrieben, muss ich den Elternkonstruktor
            NICHT noch einmal schreiben. Der Elternkonstruktor sollte manuell
            aufgerufen werden, dann werden die in dieser Klasse neuen Attribute
            initiiert. 
            Die oben angegebenen Attribute werden einfach an den 
            Elternkonstruktor weiter geleitet.
        */
        parent::__construct($name, $size, $strength);
        $this->magic = $magic;
    }

    public function sing() {
        return '<p><strong>' . $this->name . ' Lalalalalalalallalaaaaaa!</strong></p>';
    }
}