<?php

return [
    'user'           => [
        'title'          => 'Felhasználók',
        'title_singular' => 'Felhasználó',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Név',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email megerősítve ekkor',
            'email_verified_at_helper' => '',
            'password'                 => 'Jelszó',
            'password_helper'          => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
        ],
    ],
    'performer'       => [
        'title'          => 'Fellépők',
        'title_singular' => 'Fellépő',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Név',
            'name_helper'       => '',
            'email'             => 'Email',
            'email_helper'      => '',
            'phone'             => 'Telefonszám',
            'phone_helper'      => '',
        ],
    ],
    'place'         => [
        'title'          => 'Helyszínek',
        'title_singular' => 'Helyszín',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Név',
            'name_helper'       => '',
            'address'             => 'Cím',
            'address_helper'      => '',
        ],
    ],
    'event'    => [
        'title'          => 'Rendezvények',
        'title_singular' => 'Rendezvény',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Megnevezés',
            'name_helper'        => '',
            'place'              => 'Helyszín',
            'place_helper'       => '',
            'performer'          => 'Fellépő',
            'performer_helper'   => '',
            'start_time'         => 'Kezdés',
            'start_time_helper'  => '',
            'finish_time'        => 'Befejezés',
            'finish_time_helper' => '',
            'price'              => 'Ár',
            'price_helper'       => '',
            'description'        => 'Leírás',
            'description_helper' => '',
        ],
        'buttons' => [
            'buy_tickets'       => 'Több jegy vásárlása',
        ]
    ],
    'ticket'    => [
        'title'          => 'Jegyek',
        'title_singular' => 'Jegy',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'user_name'          => 'Felhasználónév',
            'user_name_helper'   => '',
            'event_name'         => 'Esemény név',
            'event_name_helper'  => '',
        ],
        'buttons' => [
            'all_tickets'       => 'Összes jegy',
            'my_tickets'        => 'Saját jegyeim'
        ]
    ],
];
