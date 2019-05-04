<?

require_once dirname(__DIR__) . '/MainClass.php';


class Master extends MainClass {


    public function __construct($db)
    {
        parent::__construct($db);
    }


    // Получить список мастеров
    public function getAll($options) {

        if($options) {

            return $this->db->masterAll();

        }

        return $this->bad("Ошибка");
    }

    // Получить информацию о мастере
    public function getDetail($options) {

        if($options) {

            if(isset($options->master_id)) {

                $id = $options->master_id;

                $masterInfo = $this->db->masterDetail($id);
                $masterServices = $this->db->masterServices($id);

                $masterInfo->services = $masterServices;

                return $masterInfo;

            }

        }

        return $this->bad("Ошибка");
    }

}