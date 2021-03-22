<?php

namespace ITTech\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use ITTech\Models\TodoModel;

/**
 * Контроллер TodoList
 *
 * @author Александр Покацкий
 */
class TodoList extends Controller {
    private $session;
    private $domain;


    public function __construct() {
        parent::__construct();
        
        $this->session = new Session();
        $this->domain  = str_replace('.', '_', $_SERVER["HTTP_HOST"]);
        
        // Проверка авторизации
        if(!$this->session->has($this->domain))
        {
            // Страница авторизации
            header('Location: /login');
            exit;
        }
        
        $this->route();
    }
    
    /**
     * Форма создания
     * @return string
     */
    protected function TodoForm()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST") {return $this->create($_POST); exit;};
        $data = ['id' => 0, 'task' => null, 'time_date' => date("Y-m-d"), 'task_desc' => null, 'title' => 'Создать задачу'];
        if(!empty($_GET['id']))
        {
            $content = TodoModel::where('id', $_GET['id'])->get()->toArray();
            $data = $content[0];
            $data['title'] = 'Изменить задачу';
            $data['time_date'] = date("Y-m-d", strtotime($data['time_date']));
        }
        $data['uid']   = $this->session->get($this->domain)['uid'];
        
        $this->view = 'todo_form.twig';
        $this->render($data);
    }
    
    /**
     * Страница списка дел
     */
    protected function Items()
    {
        if(empty($_GET['id']) || $_GET['id'] == 1)
        {
            $skip = 0;
            $take = 5;
        } else {
            $skip = $_GET['id'] * 5 - 5;
        }
        
        $items = TodoModel::where('uid', $this->session->get($this->domain)['uid'])
                ->skip($skip)->take(5)->get()->toArray();
        $model = TodoModel::where('uid', $this->session->get($this->domain)['uid'])->count();
        $pages = ceil($model / 5);

        $this->view = 'items.twig';
        $this->render(['title' => 'Список задач', 'content' => $items, 'pages' => $pages]);
    }
    
    /**
     * Маршрутизатор
     * @return string
     */
    protected function route() {
        $url = ltrim(parse_url($_SERVER["REQUEST_URI"])['path'], '/');
        if(strcasecmp ($url, 'create') == 0 || strcasecmp ($url, 'edit') == 0) return $this->TodoForm ();
        return $this->Items();
    }
    
    /**
     * Создать | Редактировать
     * @param type $data
     */
    public function create($data) {
        if($data['id'] == 0)
        {
            $model = new TodoModel();
        } else {
            $model = TodoModel::find($data['id']);
        }
        
        $model->uid       = $data['uid'];
        $model->task      = $data['title'];
        $model->task_desc = $data['desc'];
        $model->time_date = $data['date'];
        
        if($model->save())
        {
            header("refresh: 3; url=/");
            echo 'Задача сохранена';
        } else {
            header("refresh: 3; url=/");
            echo 'Ошибка! Попробуйте еще раз';
        }
    }

    /**
     * Инициализировать контроллер
     * @param string $param
     * @return TodoList
     */
    public static function init($param)
    {
        return new self();
    }
}
