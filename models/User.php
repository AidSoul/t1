<?php 

namespace app\models;

use yii\db\ActiveRecord;

/**9
 * ContactForm is the model behind the contact form.
 */
class User extends ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

}