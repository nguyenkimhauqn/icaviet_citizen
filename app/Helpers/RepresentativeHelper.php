<?php

namespace App\Helpers;

class RepresentativeHelper
{
    public static function getStateCapitals(): array
    {
        return [
            'Alabama' => 'Montgomery',
            'Alaska' => 'Juneau',
            'Arizona' => 'Phoenix',
            'Arkansas' => 'Little Rock',
            'California' => 'Sacramento',
            'Colorado' => 'Denver',
            'Connecticut' => 'Hartford',
            'Delaware' => 'Dover',
            'Florida' => 'Tallahassee',
            'Georgia' => 'Atlanta',
            'Hawaii' => 'Honolulu',
            'Idaho' => 'Boise',
            'Illinois' => 'Springfield',
            'Indiana' => 'Indianapolis',
            'Iowa' => 'Des Moines',
            'Kansas' => 'Topeka',
            'Kentucky' => 'Frankfort',
            'Louisiana' => 'Baton Rouge',
            'Maine' => 'Augusta',
            'Maryland' => 'Annapolis',
            'Massachusetts' => 'Boston',
            'Michigan' => 'Lansing',
            'Minnesota' => 'Saint Paul',
            'Mississippi' => 'Jackson',
            'Missouri' => 'Jefferson City',
            'Montana' => 'Helena',
            'Nebraska' => 'Lincoln',
            'Nevada' => 'Carson City',
            'New Hampshire' => 'Concord',
            'New Jersey' => 'Trenton',
            'New Mexico' => 'Santa Fe',
            'New York' => 'Albany',
            'North Carolina' => 'Raleigh',
            'North Dakota' => 'Bismarck',
            'Ohio' => 'Columbus',
            'Oklahoma' => 'Oklahoma City',
            'Oregon' => 'Salem',
            'Pennsylvania' => 'Harrisburg',
            'Rhode Island' => 'Providence',
            'South Carolina' => 'Columbia',
            'South Dakota' => 'Pierre',
            'Tennessee' => 'Nashville',
            'Texas' => 'Austin',
            'Utah' => 'Salt Lake City',
            'Vermont' => 'Montpelier',
            'Virginia' => 'Richmond',
            'Washington' => 'Olympia',
            'West Virginia' => 'Charleston',
            'Wisconsin' => 'Madison',
            'Wyoming' => 'Cheyenne',
        ];
    }

    public static function getCapitalByState(string $stateName): string
    {
        $capitals = self::getStateCapitals();
        return $capitals[$stateName] ?? 'Không xác định';
    }
}
