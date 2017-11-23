<?php
$translator = function($message){
    $messages = [
        'These rules must pass for {{name}}' => 'باید حرف باشد {{name}}',
    ];
    return $messages[$message];
};