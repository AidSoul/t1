<?php 
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
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
            <div class="links__item links-group">
            <?= Html::a('Корзина',['/basket']) ?>
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
        <section class="work-block">
        <div class="work-block__case">

        <?= $content ?>
        </div>
        </div>     
        </section>
    </article>
   
</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>