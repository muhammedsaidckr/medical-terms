<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'models' => [

        'department' => Msc\MedicalTerms\Models\Department::class,

        'service' => Msc\MedicalTerms\Models\Service::class,

        'symptom' => Msc\MedicalTerms\Models\Symptom::class,
    ],

    'table_names' => [

        'departments' => 'departments',

        'services' => 'services',

        'symptoms' => 'symptoms',
    ]
];
