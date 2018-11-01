<?php
class Textarea extends Input {
    public function renderField() {
        $out = '';
        $out .= '<textarea ' .
                'name="' . $this->name . '" ' . 
                'id="' . $this->id . '"' .
                $this->renderTagAttributes() .
                '>' .
                '</textarea>';
        return $out;
    }
}