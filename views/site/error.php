<?php
use yii\helpers\Html;
$this->title = $name;
// Html::encode($this->title) 
if(!empty(Yii::$app->user->id)){
    $er = 'Вы уже авторизированы!';
}
else{
    $er = 'Ошибка доступа. Недостаточно прав, для просмотра этой страницы.';
}
?>


<div class="site-error">
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
        <? echo $er ?>
    </div>
</div>
