<?php

declare(strict_types=1);

use Rinvex\Contacts\Models\Contact;

return [

    // Contacts Database Tables
    'tables' => [
        'contacts' => 'contacts',
        'contact_relations' => 'contact_relations',
    ],

    // Contacts Models
    'models' => [
        'contact' => Contact::class,
    ],

];
