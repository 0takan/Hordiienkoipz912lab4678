<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city_language".
 *
 * @property int $city_id
 * @property string $language
 * @property string $name_language
 *
 * @property City $city
 */
class CityLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'language', 'name_language'], 'required'],
            [['city_id'], 'integer'],
            [['language'], 'string', 'max' => 20],
            [['name_language'], 'string', 'max' => 100],
            [['city_id', 'language'], 'unique', 'targetAttribute' => ['city_id', 'language']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'language' => 'Language',
            'name_language' => 'Name Language',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
    }
}
