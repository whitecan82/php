<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tableInfo".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $author
 */
class Board extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tableInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'date', 'author'], 'required'],
            [['title', 'description', 'date', 'author'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'author' => 'Author',
        ];
    }
}
