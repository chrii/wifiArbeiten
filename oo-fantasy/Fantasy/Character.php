<?php
/* 
    Basisklasse für Orc und Dwarf. Es werden alle gemeinsamen Attribute und
    Methoden deklariert. 
*/
class Character {
    protected $name;
    protected $strength;
    protected $size;
    protected $life;

    public function __construct(string $name,
                                int $size=0,
                                int $strength=240) {
        $this->name = $name;
        $this->strength = $strength;
        $this->setSize($size);
        $this->life = rand(150, 300);
        
        echo $this->say(
            'Hallo, ich heiße ' . $this->name .
            '. Ich bin '. $this->size . ' cm groß und ' . 
            $this->strength . ' stark!' .
            ' Meine Lebenskraft ist ' . $this->life . ' hoch!'
        );

    }

    public function say(string $text) {
        return "<p class=\"say\">$text</p>";
    }

    protected function setSize(int $size) {
        if ($size <= 0) {
            $this->size = rand(220, 250);
        }
        else {
            $this->size = $size;
        }
    }
}