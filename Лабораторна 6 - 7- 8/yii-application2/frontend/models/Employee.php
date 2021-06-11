<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $employee_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int|null $user_id
 * @property int $department_id
 * @property string|null $image
 *
 * @property User $user
 * @property Department $department
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'department_id'], 'required'],
            [['user_id', 'department_id'], 'integer'],
            [['first_name', 'last_name', 'email', 'image'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'department_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'user_id' => 'User ID',
            'department_id' => 'Department',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['department_id' => 'department_id']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->user_id = Yii::$app->user->getId();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
