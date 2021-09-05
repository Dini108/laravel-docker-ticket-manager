<?php

return [
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'password',
            'password_helper'          => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
        ],
    ],
    'performer'       => [
        'title'          => 'Performers',
        'title_singular' => 'Performer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'email'             => 'Email',
            'email_helper'      => '',
            'phone'             => 'Phone',
            'phone_helper'      => '',
        ],
    ],
    'place'         => [
        'title'          => 'Places',
        'title_singular' => 'Place',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'address'             => 'Address',
            'address_helper'      => '',
        ],
    ],
    'event'    => [
        'title'          => 'Events',
        'title_singular' => 'Event',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'place'              => 'Place',
            'place_helper'       => '',
            'performer'          => 'Performer',
            'performer_helper'   => '',
            'start_time'         => 'Start Time',
            'start_time_helper'  => '',
            'finish_time'        => 'Finish Time',
            'finish_time_helper' => '',
            'price'              => 'Price',
            'price_helper'       => '',
            'description'        => 'Description',
            'description_helper' => '',
        ],
        'buttons' => [
            'buy_tickets'       => 'Buy tickets',
        ]
    ],
    'ticket'    => [
        'title'          => 'Tickets',
        'title_singular' => 'Ticket',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'user_name'          => 'Name',
            'user_name_helper'   => '',
            'event_name'         => 'Event Name',
            'event_name_helper'  => '',
        ],
        'buttons' => [
            'all_tickets'       => 'All tickets',
            'my_tickets'        => 'My tickets'
        ]
    ],
];
