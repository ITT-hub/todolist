<?php

namespace ITTech\Models;

/**
 * Модель пользователей
 *
 * @author Александр Покацкий
 */
class UserModel extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'users';
    public $timestamps = false;
}
