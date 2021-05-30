<?php
$folder = ['site','user','admin'];

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    // 'suffix' => '.html',
    'rules' => [
        // '<action:(about|basket)>' => 'site/</action>',
        '' => 'site/index',
        'comment' => $folder[0].'/comment',
        'comment-remove' => $folder[0].'/comment-remove',
        'about' => $folder[0].'/about',
        'basket' => $folder[1].'/basket',
        'add-basket' => $folder[1].'/add-basket',
        'remove-basket' => $folder[1].'/remove-basket',
        'redirection' => $folder[1].'/redirection',
        'login' => $folder[1].'/login',
        'signup' => $folder[1].'/signup',
        'logout' => $folder[1].'/logout',
        'product-add'=> $folder[2].'/product-add',
        'category-add'=> $folder[2].'/category-add',
        'product-remove'=> $folder[2].'/product-remove',
        'add-count' => $folder[2].'/add-count',
    ]
    ];