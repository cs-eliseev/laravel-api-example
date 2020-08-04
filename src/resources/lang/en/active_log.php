<?php


use Illuminate\Http\Request;

return [
    'description' => [
        Request::METHOD_GET     => 'Viewed',
        Request::METHOD_POST    => 'Created',
        Request::METHOD_DELETE  => 'Deleted',
        Request::METHOD_PUT     => 'Edited',
    ]
];
