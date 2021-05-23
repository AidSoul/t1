Корзина
<?php 
use app\rbac\AuthorRule;
$auth = Yii::$app->authManager;


if (\Yii::$app->user->can('createPost')) {
   echo 'Могу';
}
else{
    echo 'Не могу'; 
}
?>