<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float|null $price
 * @property string $location_text
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $moderator_status
 * @property int|null $moderator_status_setter_id
 * @property string|null $citizen_status
 * @property int|null $citizen_status_setter_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $citizenStatusSetter
 * @property Users $moderatorStatusSetter
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location_text'], 'required'],
            [['description'], 'string'],
            [['price', 'latitude', 'longitude'], 'number'],
            [['moderator_status_setter_id', 'citizen_status_setter_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 500],
            [['location_text'], 'string', 'max' => 255],
            [['moderator_status', 'citizen_status'], 'string', 'max' => 16],
            [['citizen_status_setter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['citizen_status_setter_id' => 'id']],
            [['moderator_status_setter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['moderator_status_setter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'price' => 'Стоимость',
            'location_text' => 'Местоположение',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'moderator_status' => 'Статус модератора',
            'moderator_status_setter_id' => 'Модератор',
            'citizen_status' => 'Статус проверки',
            'citizen_status_setter_id' => 'Проверил',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[CitizenStatusSetter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCitizenStatusSetter()
    {
        return $this->hasOne(Users::class, ['id' => 'citizen_status_setter_id']);
    }

    /**
     * Gets query for [[ModeratorStatusSetter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModeratorStatusSetter()
    {
        return $this->hasOne(Users::class, ['id' => 'moderator_status_setter_id']);
    }
}
