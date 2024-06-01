<?php
namespace MyApp\controllers;
class Home{
    // protected $container;
    protected $view;
    public function __construct($view){
        // isso aqui surge com a necessidade de utilizarmos os métodos já embutidos no slim framework
        $this->view= $view;
    }
    public function index($request, $response){
        var_dump($this->view);
        return $response->write('chegamos aqui');
    }
}