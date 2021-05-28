<?php
namespace app\models\forms;

use yii\base\Model;


class CommentForm extends Model 
{
    public $text;

    public function attributeLabels()
    {
      return [
          'text' => 'Текст комментария',
      ];
    }

    public function rules(){
        return [
          [['text'], 'required'],
          [['text'],'string'],
        ];
    }
}