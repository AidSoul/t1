<?php

function getProfile($userStatus, $data){
    if($userStatus){
        return '<div class="user-profile__case">
        <div class="user-profile__item text-center">Профиль</div>
        <div class="user-profile__item text-center">'.$data[0].'</div>
        <div class="user-profile__item text-center">'.$data[1].'</div>               
        </div>';
    }
}
