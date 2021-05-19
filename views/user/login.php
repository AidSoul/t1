<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Notifications;
?>



<?php 


if( Yii::$app->session->hasFlash('success')){
echo Notifications::widget(['type'=>'success','message'=>Yii::$app->session->getFlash('success')]);
Yii::$app->session->destroy('success');

}
elseif(Yii::$app->session->hasFlash('error')){
   echo Notifications::widget(['type'=>'danger','message'=>Yii::$app->session->getFlash('error')]);
   Yii::$app->session->destroy('error');
  }

?> 

<?php $form = ActiveForm::begin(['options'=>['class'=>'form']]) ?>
<?= $form->field($model, 'login')?>
<?= $form->field($model, 'pass')->passwordInput()?>
<br>
<?= Html::submitButton('Вход',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>

