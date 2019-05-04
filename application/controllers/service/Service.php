<?

require_once dirname(__DIR__) . '/MainClass.php';


class Service extends MainClass {


    public function __construct($db)
    {
        parent::__construct($db);
    }


    // Получить список услуг
    public function getAll($options) {

        if($options) {

            return $this->db->serviceAll();

        }

        return $this->bad("Ошибка");
    }

}