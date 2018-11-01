<?php
class Select extends Input {
    private $options = [];

    public function __construct(array $conf) {
        /*
            Damit wir uns das duplizieren des Eltern Konstruktors ersparen und damit auch
            bei evtl. Änderungen flexibler sind, rufen wir den Konstruktor der Elternklasse auf.
            Wir übergeben das Array $conf, das ja die selbe Struktur aufweisen muss.
            Wir schreiben danach nur, was vom Elternkonstruktor abweicht.
        */
        parent::__construct($conf);

        $this->options = $conf['options'];
    }

    public function renderField() {
        $out = '';
        $out .= '<select ' .
                'name="' . $this->name . '" ' . 
                'id="' . $this->id . '"' .
                $this->renderTagAttributes() .
                '>';
        $out .= $this->renderOptions();
        $out .= '</select>';
        return $out;
    }

    private function renderOptions() {
        $out = '';
        // options
        foreach($this->options as $val => $text) {
            $out .= "<option value=\"$val\">$text</option>";
        }
        return $out;
    }
}