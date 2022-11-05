<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string|null $role
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Projects[] $projects
 * @property Projects[] $projects0
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['role'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['login', 'password'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'role' => 'Role',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::class, ['citizen_status_setter_id' => 'id']);
    }

    /**
     * Gets query for [[Projects0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects0()
    {
        return $this->hasMany(Projects::class, ['moderator_status_setter_id' => 'id']);
    }
}
