<?
// общий класс
class MainClass {

    public $db; // база данных

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Плохой ответ, возвращаем ошибку
    public function bad($text) {
        return ['result' => false, 'error' => $text];
    }

    // Хороший оответ, возвращаем ошибку
    public function good($text) {
        return ['result' => true, 'data' => $text];
    }

}