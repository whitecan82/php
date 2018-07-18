<?php

namespace app\models;

use Yii;


class DropList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testdrop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeName'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeName' => 'Name',
        ];
    }
    
    
    

}
