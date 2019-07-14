<?


require_once __DIR__ . '/modules/db/db.php';
require_once __DIR__ . '/controllers/schedule/Schedule.php';
require_once __DIR__ . '/controllers/service/Service.php';
require_once __DIR__ . '/controllers/master/Master.php';


class Router {

    public $schedule; // Расписание
    public $service; // Услуга
    public $master; // Мастер

    public $db; // База данных


    public function __construct()
    {
        $this->db = new DB('PRODUCTION');

        $this->schedule = new Schedule($this->db);
        $this->service = new Service($this->db);
        $this->master = new Master($this->db);
    }


    // Плохой ответ, возвращаем ошибку
    private function bad($text) {
        return ['result' => false, 'error' => $text];
    }

    // Выбор ответа
    public function answer($options) {
        $schedule = $this->schedule;
        $service = $this->service;
        $master = $this->master;

        if($options && isset($options->method)) {
            $method = $options->method;


            if($method) {

                    switch($method) {

                        // получить расписание по фильтру
                        case 'schedule.filter': return $schedule->getByFilter($options); break;

                        // выбрать расписание
                        case 'schedule.choose': return $schedule->chooseSchedule($options); break;

                        // получить список услуг
                        case 'service.all': return $service->getAll($options); break;

                        // получить список мастеров
                        case 'master.all': return $master->getAll($options); break;

                        // получить информацию о мастере
                        case 'master.get': return $master->getDetail($options); break;


                    }


            }
        }
        return $this->bad('Неправильная команда');
    }

}