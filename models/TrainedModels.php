<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trained_models".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Settings[] $settings
 */
class TrainedModels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trained_models';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Settings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::class, ['trained_model_id' => 'id']);
    }
}
