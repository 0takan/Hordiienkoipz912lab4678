<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "continent".
 *
 * @property int $continent_id
 * @property string $code Continent code
 * @property string|null $name
 * @property string $description
 *
 * @property Country[] $countries
 */
class Continent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'continent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'description'], 'required'],
            [['description'], 'string'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'continent_id' => 'Continent ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Countries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['continent_id' => 'continent_id']);
    }
}
