<?php 

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\components\Notification;

AppAsset::register($this);
// <?= Html::a('Каталог',['/'],['class'=>'nav-link'])

?>

<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="UTF-8">
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap"
        rel="stylesheet">
        <?php $this->head()?>
    </head>
    <body>
 
    <?php $this->beginBody()?>

    <div class="container">
    <div class="page">     
    <header>
    <?php
    if(Yii::$app->user->userExistenceCheck()){
    ?>
    <div class="user-profile__case">
    <div class="user-profile__item text-center">Профиль</div>
     <div class="user-profile__item text-center"><?= Yii::$app->user->fio ?></div>
    <?php
         if(Yii::$app->user->getStatus() === 1){

        
    ?>
    <div class="user-profile__item text-center"><?= Html::a('Добавить Товар',['/product-add']) ?></div>
    <div class="user-profile__item text-center"><?= Html::a('Добавить Категорию',['/category-add']) ?></div>
   <?php
    } 
   ?>
 
    <div class="user-profile__item text-center"><?= Html::a('Выход',['/logout'])?></div>               
    </div>
    <?php }?>

        <nav class="links">
            <div class="links__item">
               <span class="span-logo">Керамика</span>      
            </div>
            <div class="links__item links-group">
            <?= Html::a('Каталог',['/'])?>
            </div>
            <div class="links__item links-group">
            <?= Html::a('О нас',['/about']) ?>
            </div>
            <?php 

            $count = new \app\models\tables\Basket;
          
            if(($count) ){
                $countGet =  (integer) count($count->countBasket());
                if($countGet > '0'){
                    $count =  '<span>('.$countGet.')</span>'; 

                }
                else{
                    $count = '';
                }
                
            }
            else{
                $count = '';
            }
           

            ?>
            <div class="links__item links-group">
            <?= Html::a("🗑 Корзина ".$count,['/basket'],['class'=>'link']) ?>
            </div>  
            <div class="links__item links-group">
            <?= Html::a('Вход',['/login']) ?>
            </div>
            <div class="links__item links-group">        
        <?= Html::a('Регистрация',['/signup']) ?>
            </div>
        </nav>
    </header>
    <article>
        <?php   echo  Notification::widget(); ?>
        <?= $content ?>
    </article>
   
</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>