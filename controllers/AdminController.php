<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\components\AddNotifi;

class AdminController extends Controller
{
   public function actionProductAdd()
   {
      
      $model = new \app\models\forms\ProductAddForm;
      $model->load(\Yii::$app->request->post());

        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
              AddNotifi::widget(['type'=>'success','message'=>"Уряяя, товар успешно добавлен"]);
          $goods = new \app\models\tables\Goods;
          $goods->addGoods($model);
            }
        }

      $this->view->title = 'Добавить товар';
       return $this->render('ProductAdd', compact('model'));
   }

   public function actionProductRemove($remove, $image)
   {
        $request = Yii::$app->request;
      if($request->get('remove')){
        $goods = new \app\models\tables\Goods;
        $goods->removeGoods($remove,$image);
        AddNotifi::widget(['type'=>'danger','message'=>"Товар удалён"]);
        $this->goHome();
      }

   }
   
   public function actionCategoryAdd()
   {
      
      $model = new \app\models\forms\CategoryAddForm; 
      $model->load(\Yii::$app->request->post());

      if($model->validate()){
        $category = new \app\models\tables\Category;
        $category->addCategory($model->name);
        AddNotifi::widget(['type'=>'success','message'=>"Уряяя, категория добавлена"]);
      }
      else {
        $errors = $model->errors;
    }
      $this->view->title = 'Добавить категорию';

       return $this->render('CategoryAdd', compact('model'));
   }


}
