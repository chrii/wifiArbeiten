<?php
/* 
    extends: Orc erbt alle public und protected Eigenschaften und
    Methoden von Character. Besitzt die Basisklasse private A/M,
    dann hat Orc keinen Zugriff darauf.
    protected: kann nicht von außen zugegriffen werden, aber von innerhalb
    der Klasse und in allen abgeleiteten Klassen.
    private: kann nicht von außen zugegriffen werden, nur innerhalb der 
    eigenen Klasse verwendbar. Abgeleitete Klassen haben keinen Zugriff.
*/
class Orc extends Character {
    protected $weapon;
    protected $skincolor;

    public function __construct(string $name,
                                string $weapon,
                                int $size=0,
                                string $skincolor='green',
                                int $strength=240) {
        $this->name = $name;
        $this->weapon = $weapon;
        $this->skincolor = $skincolor;
        $this->strength = $strength;
        $this->setSize($size);
        $this->life = rand(150, 300);
        
        echo $this->say(
            'Hallo, ich heiße ' . $this->name .
            ', meine Lieblingswaffe ist ' . $this->weapon .
            '. Ich bin stolz auf meine Hautfarbe - ' . $this->skincolor .
            '. Ich bin '. $this->size . ' cm groß und ' . 
            $this->strength . ' stark!' .
            ' Meine Lebenskraft ist ' . $this->life . ' hoch!'
        );

    }

    /*
        say wurde von Character geerbt. Soll sich aber die say Funktion des
        Orc von der des Characters unterscheiden, überschreiben wir die say 
        Funktion: Dh. beim Aufruf wird nicht die Funktion Character::say aufgerufen, sondern Orc::say

        Wird in einer abgeleiteten Klasse eine Funktion mit dem selben Namen
        wie in der Elternklasse deklariert, überschreibt die neue Funktion die
        der Elternklasse. (Kein overloading möglich)
    */
    public function say(string $text) {
        return "<p class=\"say-orc\">$text</p>";
    }

    public function shout() {
        return '<p><strong>' . $this->name . ' UUUAAAAAAHHHHHH!</strong></p>';
    }
}