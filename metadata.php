<?php

$sMetadataVersion = '2.1';


$aModule = [
        'id'          =>'nnapiconfigure',
        'title'       => [
            'de' => 'Novalnet API Configure',
            'en' => 'Novalnet API Configure',
        ],
        'description' => [ 'de' => 'This Extension for Novalnet API Configuration',
                           'en' => 'This Extension for Novalnet API Configuration',
        ],
        'thumbnail'   => 'img/nnapi.png',
        'version'     => '13.2.0',
        'author'      => 'Novalnet Developer',
        'url'         => 'https://www.novalnet.com',
        'email'       => 'technical@novalnet.de',
        'extend'      => [
         
         
        ],
        'controllers'  => [  
              
            
        ],


        'settings'      => [
            ['group' => 'nnapiconfiguration', 'name' => 'paymentaccesskey','type' => 'str',   'value'  => '', 'position' => 1 ],
            ['group' => 'nnapiconfiguration', 'name' => 'productactivationkey',    'type' => 'str',   'value'  => '', 'position' => 2 ],
            ['group' => 'nnapiconfiguration', 'name' => 'traiffid',    'type' => 'str',   'value'  => '', 'position' => 3 ],
            ['group' => 'nnapiconfiguration', 'name' => 'clientkey',    'type' => 'str',   'value'  => '', 'position' => 4 ],
            ['group' => 'nnapiconfiguration', 'name' => 'projectid',    'type' => 'str',   'value'  => '', 'position' => 5 ],
            
            
        ],
        'events'    => [
           
        ],
];
