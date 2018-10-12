<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 12.10.2018
 * Time: 17:54
 */

namespace app\models;

use yii\base\Model;

class RegistrationForm extends Model {
    public $username;
    public $password;

    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'Не может быть пустым!'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Этот логин уже занят!'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }
}
