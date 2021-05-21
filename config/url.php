<?php
$folder = ['site','user'];

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    // 'suffix' => '.html',
    'rules' => [
        // '<action:(about|basket)>' => 'site/</action>',
        'about' => $folder[0].'/about',
        'basket' => $folder[0].'/basket',
        'login' => $folder[1].'/login',
        'signup' => $folder[1].'/signup',
        'logout' => $folder[1].'/logout'
    ]
    ];