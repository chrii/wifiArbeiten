<?php
require_once 'Formlib/Input.php';
require_once 'Formlib/Textarea.php';
require_once 'Formlib/Select.php';

$formConf = [
    'vorname' => [
        'name' => 'vorname',
        'id' => 'vorName',
        'type' => 'text',
        'label' => 'Vorname',
        'tagAttributes' => [
            'class' => 'single-field',
            'data-gui' => 'mainfield',
            'title' => 'wichtig',
            'placeholder' => 'Her mit dem Vornamen',
        ]
    ],
    'nachname' => [
        'name' => 'nachname',
        'id' => 'nachname',
        'type' => 'text',
        'label' => 'Nachname',
        'tagAttributes' => [
            'class' => 'single-field',
            'title' => 'wichtig',
            'placeholder' => 'Her mit dem Nachnamen'
        ]
        
    ],
    'nachricht' => [
        'name' => 'nachricht',
        'id' => 'nachricht',
        'type' => 'textarea',
        'label' => 'Nachricht',
        'tagAttributes' => [
            'cols' => 40,
            'rows' => 10
        ]
    ],
    'bundeslaender' => [
        'name' => 'bundeslaender',
        'id' => 'bundesLaender',
        'type' => 'select',
        'label' => 'Bundesländer',
        'tagAttributes' => [
        'size' => 5 
        ],
        'options' => [
            'Wien' => 'Wien',
            'noe' => 'Niederösterreich',
            'szbg' => 'Salzburg'
        ]
    ]
];
