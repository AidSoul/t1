Корзина
<?php 
    $auth = Yii::$app->authManager;
    $authorRole = $auth->getRole('author');
    $auth->assign($authorRole, $user->getId());
?>