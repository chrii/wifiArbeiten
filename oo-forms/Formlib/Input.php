<?php
class Input {
    protected $name;
    protected $id;
    protected $type;
    protected $label;
    protected $value = '';
    protected $tagAttributes = [];

    public function __construct(array $conf) {
        // required attributes
        $this->name = $conf['name'];
        $this->id = $conf['id'];
        $this->type = $conf['type'];
        $this->label = $conf['label'];

        // optionale Attribute
        if (array_key_exists('value', $conf)){
            $this->value = $conf['value'];
        }
        
        // Wenn tagAttributes vorhanden, wenn es ein Array und wenn es nicht leer ist
        if (array_key_exists('tagAttributes', $conf) && 
            is_array($conf['tagAttributes']) &&
            !empty($conf['tagAttributes'])) {
            $this->tagAttributes = $conf['tagAttributes'];
        }
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

    /**
     * HTML des Labels erzeugen
     *
     * @return string
     */
    public function renderLabel() {
        $out = '';
        $out .= '<label for="' . $this->id . '">' . $this->label . '</label>';
        return $out;
    }

    /**
     * HTML des Input Feldes erzeugen
     *
     * @return string
     */
    public function renderField() {
        $out = '';
        $out .= '<input type="' . $this->type . '" ' .
                'name="' . $this->name . '" ' . 
                'id="' . $this->id . '"';
                
        if ($this->value !== '') {
            $out .= ' value="' . $this->value . '"';
        }

        $out .= $this->renderTagAttributes() . '>';
        return $out;
    }

    protected function renderTagAttributes() {
        $out = '';
        $delimiter = '';
        foreach($this->tagAttributes as $name => $val) {
            $out .= $delimiter . $name . '="' . $val . '"';
            $delimiter = ' ';
        }
        return $out;
    }
}