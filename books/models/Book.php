<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property string $name
 * @property string $author
 * @property int $year
 * @property string $genre
 * @property string $image
 * @property int $page
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author', 'year', 'genre', 'page'], 'required', 'message' => 'Не может быть пустым!'],
            [['year', 'page'], 'integer', 'message' => 'Только целые числа!'],
            [['year', 'page'], 'integer', 'min' => 1, 'tooSmall' => 'Только положительные числа!'],
            [['name', 'author', 'image'], 'string', 'max' => 100 ],
            [['genre'], 'string', 'max' => 50],
            [['name'], 'unique', 'message' => 'Не может повторяться!'],
            [['author', 'name', 'genre'], 'match', 'pattern' => '^[A-Za-zА-Яа-яё_\s,]+$^', 'message' => 'Не может включать цифры!'],
            [['image'], 'file', 'extensions' => 'jpg, png', 'wrongExtension' => 'Только JPG и PNG!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'author' => 'Автор',
            'year' => 'Год выпуска',
            'genre' => 'Жанр',
            'image' => 'Картинка',
            'page' => 'Страницы',
        ];
    }
}
