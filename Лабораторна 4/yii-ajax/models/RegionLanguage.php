<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region_language".
 *
 * @property int $region_id
 * @property string $language
 * @property string $name_language
 *
 * @property Region $region
 */
class RegionLanguage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'language', 'name_language'], 'required'],
            [['region_id'], 'integer'],
            [['language'], 'string', 'max' => 20],
            [['name_language'], 'string', 'max' => 100],
            [['region_id', 'language'], 'unique', 'targetAttribute' => ['region_id', 'language']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'region_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'language' => 'Language',
            'name_language' => 'Name Language',
        ];
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['region_id' => 'region_id']);
    }
}
