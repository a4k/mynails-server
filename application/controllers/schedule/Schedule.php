<?php

require_once __DIR__ . '/MainClass.php';

// Расписание
class Schedule extends MainClass {


    public function __construct($db)
    {
        parent::__construct($db);

    }


    // получить расписание по фильтру
    public function getByFilter($options) {

        if($options) {

            $arFilter = array(); // Массив для фильтрации по полям

            // Формирования массива фильтра
            if(isset($options->day)) {
                $arFilter["day"] = $options->day;
            }
            if(isset($options->month)) {
                $arFilter["month"] = $options->month;
            }
            if(isset($options->year)) {
                $arFilter["year"] = $options->year;
            }
            if(isset($options->master_id)) {
                $arFilter["master_id"] = $options->master_id;
            }
            if(isset($options->service_id)) {
                $arFilter["service_id"] = $options->service_id;
            }



            return $this->db->scheduleGetByFilter($arFilter);

        }

        return $this->bad("Ошибка");
    }

    // выбрать расписание
    public function chooseSchedule($options) {

        if($options) {

            if(isset($options->schedule_id) && isset($options->name) && isset($options->phone)) {

                $schedule_id = $options->schedule_id;
                $name = $options->name;
                $phone = $options->phone;

                $result = $this->db->orderCreate($schedule_id, $name, $phone);

                return $this->good($result);
            }


        }
        return $this->bad("Ошибка");
    }

}