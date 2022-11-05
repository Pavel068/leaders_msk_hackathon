<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property int|null $trained_model_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TrainedModels $trainedModel
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trained_model_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['trained_model_id'], 'exist', 'skipOnError' => true, 'targetClass' => TrainedModels::class, 'targetAttribute' => ['trained_model_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trained_model_id' => 'Trained Model ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TrainedModel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrainedModel()
    {
        return $this->hasOne(TrainedModels::class, ['id' => 'trained_model_id']);
    }
}
