<?php

namespace ITTech\Models;

/**
 * Модель списка дел
 *
 * @author Александр Покацкий
 */
class TodoModel extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'todo_list';
    public $timestamps = false;
}
