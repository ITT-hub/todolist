<?php

namespace ITTech\Controllers;

use ITTech\Models\UserModel;

/**
 * Контроллер пользователей
 *
 * @author Александр Покацкий
 */
class User extends Controller {
    /**
     * Регистрация
     * @return mixed
     */
    public function reg() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {return $this->create($_POST); exit;};
        $this->view = 'register.twig';
        $this->render();
    }
    
    /**
     * Авторизация
     * @return mixed
     */
    public function auth() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {return $this->login($_POST); exit;};
        $this->view = 'auth.twig';
        $this->render();
    }
    
    /**
     * Создать учетку
     * @param array $param
     */
    private function create(array $param) {
        // Проверить пользователя
        if(UserModel::where('login', $param['login'])->count() > 0) exit ('Такой логин уже есть в системе');
        if(UserModel::where('email', $param['email'])->count() > 0) exit ('Такой Email уже есть в системе');
        
        // Создать учетку
        $model             = new UserModel();
        $model->login      = $param['login'];
        $model->email      = $param['email'];
        $model->last_name  = $param['last_name'];
        $model->first_name = $param['first_name'];
        $model->password   = password_hash($param['password'], PASSWORD_DEFAULT);
        
        if($model->save())
        {
            header("refresh: 3; url=/login");
            echo 'Учетная запись зарегестрирована';
        } else {
            header("refresh: 3; url=/register");
            echo 'Ошибка регистрации пользователя';
        }
    }
    
    /**
     * Авторизировать пользователя
     * @param array $param
     */
    public function login($param) {
        $user = UserModel::where('email', $param['email'])->get();
        if(count($user) < 1)
        {
            header("refresh: 3; url=/login");
            echo 'Учетная запись не найдена';
        } else {
            if(password_verify($param['password'], $user[0]->password))
            {
                $domain  = str_replace('.', '_', $_SERVER["HTTP_HOST"]);
                $session = new \Symfony\Component\HttpFoundation\Session\Session();
                $session->set($domain, ['uid' => $user[0]->id]);
                
                header("refresh: 3; url=/");
                echo 'Вход выполнен';
            } else {
                header("refresh: 3; url=/login");
                echo 'Ошибка входа';
            }
        }
    }


    /**
     * Инициализировать
     * @param string $root
     * @return mixed
     */
    public static function init($root) {
        $class = new self();
        $url   = ltrim($_SERVER["REQUEST_URI"], '/');
        
        if(strcasecmp($url , 'login' ) == 0)
        {
            return $class->auth();
        } else {
            return $class->reg();
        }
    }
}
