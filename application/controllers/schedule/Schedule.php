<?php

require_once dirname(__DIR__) . '/MainClass.php';

// Расписание
class Schedule extends MainClass {


    public function __construct($db)
    {
        parent::__construct($db);

    }

    // получить расписание по мастеру
    public function getByMaster($options) {

        if($options) {

            if(isset($options->master_id)) {

                $id = $options->master_id;

                return $this->db->scheduleGetByMaster($id);

            }

        }

        return $this->bad("Ошибка");
    }

    // получить расписание по услуге
    public function getByService($options) {

        if($options) {

            if(isset($options->service_id)) {

                $id = $options->service_id;

                return $this->db->scheduleGetByService($id);

            }

        }

        return $this->bad("Ошибка");
    }

    // получить конкретное расписание по ID
    public function getSchedule($options) {

        return $this->bad("Ошибка");
    }

    // получить расписание по времени
    public function getByTime($options) {

        if($options) {

            if(isset($options->time)) {

                $time = $options->time;

                return $this->db->scheduleGetByTime($time);

            }

        }

        return $this->bad("Ошибка");
    }

    // получить расписание по дате
    public function getByDate($options) {

        return $this->bad("Ошибка");
    }

    // выбрать расписание
    public function chooseSchedule($options) {

        return $this->bad("Ошибка");
    }
}