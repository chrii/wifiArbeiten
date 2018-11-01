<?php
class Input {
    protected $name;
    protected $id;
    protected $type;
    protected $label;

    public function __construct(string $name, string $id, string $type, string $label) {
        // TODO: Werte prüfen. Z. B. type gegen eine whitelist aus erlaubten types prüfen.
        $this->name = $name;
        $this->id = $id;
        $this->type = $type;
        $this->label = $label;
    }

    /**
     * Erzeugt das HTML für den Label und das Input Feld
     */
    public function render() : string {
        $out = '';
        $out .= $this->renderLabel();
        $out .= $this->renderField();
        return $out;
    }

    public function renderLabel() {
        $out = '';
        $out .= '<label for="' . $this->id . '">' . $this->label . '</label>';
        return $out;
    }

    public function renderField() {
        $out = '';
        $out .= '<input type="' . $this->type . '" ' .
                'name="' . $this->name . '" ' . 
                'id="' . $this->id . '">';
        return $out;
    }
}