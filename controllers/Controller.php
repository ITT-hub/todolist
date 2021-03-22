<?php

namespace ITTech\Controllers;

/**
 * Центральный контроллер
 *
 * @author Александр Покацкий
 */
Abstract class Controller implements iController {
    /**
     * Шаблон страницы
     * @var string
     */
    protected $view = null;
    
    public function __construct() {
        // Подключиться к базе данных
        \ITTech\Models\Connect::DB();
    }

    /**
     * Выдать шаблон
     * @param array $data
     */
    public function render(array $data=[]) {
        $loader = new \Twig\Loader\FilesystemLoader($_SERVER["DOCUMENT_ROOT"].'/views');
        $twig = new \Twig\Environment($loader);

        echo $twig->render($this->view, $data);
    }
}
