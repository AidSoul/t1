<?php
namespace app\models\forms;


use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;
class ProductAddForm extends Model 
{
    public $name;
    public $image;
    public $price;
    public $description;
    public $count;
    public $category;

    public function attributeLabels()
    {
      return [
          'name' => 'Название',
          'image' => 'Изображение',
          'price' => 'Цена',
          'description' => 'Описание',
          'count' => 'Количество на складе',
          'category' => 'Категория'
      ];
    }

    public function rules(){
        return [
          [[ 'name', 'image','price','description','count','category'], 'required'],
          [['name','category'],'string','length' => [1,35]],
          [['price'],'double'],
          [['count'],'integer'],
          [['description'],'string','length' => [1,2000]],
          ['image','image',
            'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
            'checkExtensionByMimeType' => true,
            'maxSize' => 1048576, 
            'tooBig' => 'Лимит 1 МБ'
      ],
        ];
    }

    public function randomFileName()
    {
        return md5($this->image->baseName). '.' . $this->image->extension;
    }

    public function upload(){
        if ($this->validate()) {
            $this->image->saveAs('img/' . $this->randomFileName());
            return true;
        } else {
            return false;
        }

      
    }

}