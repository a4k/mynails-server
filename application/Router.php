<?


require_once dirname(__DIR__) . '/application/modules/db/db.php';
require_once dirname(__DIR__) . '/application/controllers/schedule/schedule.php';
require_once dirname(__DIR__) . '/application/controllers/service/service.php';
require_once dirname(__DIR__) . '/application/controllers/master/master.php';


class Router {

    public $schedule; // Расписание
    public $service; // Услуга
    public $master; // Мастер

    public $db; // База данных


    public function __construct()
    {
        $this->db = new DB();

        $this->schedule = new Schedule($this->db);
        $this->service = new Master($this->db);
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

                        // получить расписание по мастеру
                        case 'schedule.master': return $schedule->getByMaster($options); break;

                        // получить расписание по услуге
                        case 'schedule.service': return $schedule->getByService($options); break;

                        // получить конкретное расписание по ID
                        case 'schedule.get': return $schedule->getSchedule($options); break;

                        // получить расписание по времени
                        case 'schedule.bytime': return $schedule->getByTime($options); break;

                        // получить расписание по дате
                        case 'schedule.bydate': return $schedule->getByDate($options); break;

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