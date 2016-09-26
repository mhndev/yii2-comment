<?php


return [

    'OPTIONS <opts:(.*)>' => 'agency/agency/options',
    'GET  /comment' => '/comment/comment/index',
    'POST /comment' => '/comment/comment/create',
    'POST /comment/reply/<id>' => '/comment/comment/reply',
    'GET /comment/<id>' => '/comment/comment/show',
    'DELETE /comment/multiple' =>'/comment/comment/delete-multiple',
    'DELETE /comment/<id>' =>'/comment/comment/delete',
    'PUT /comment/<id>' =>'/comment/comment/update',

];
