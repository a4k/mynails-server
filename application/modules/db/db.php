<?php

class DB {

    private $connection;

    public function __construct() {
        // $host = 'localhost';
        $host = '192.168.0.102';
        $dbName = 'mynails';
        $user = 'root';
        $pass = '';
        $this->connection = new PDO('mysql:dbname=' . $dbName . ';host=' . $host, $user, $pass);
    }



    // получить расписание по мастеру
    public function scheduleGetByMaster($master_id) {
        $sql = 'SELECT * FROM schedules WHERE master_id = :master_id';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':master_id', $master_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // получить расписание по услуге
    public function scheduleGetByService($service_id) {
        $sql = 'SELECT * FROM schedules WHERE service_id';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':service_id', $service_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // Получить конкретное расписание по ID
    public function scheduleGetSchedule($schedule_id){
        $sql = 'SELECT * from schedules WHERE id=:schedule_id'; //SQl запрос
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':schedule_id', $schedule_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchObject('stdClass');
    }

    // получить расписание по времени
    public function scheduleGetByTime($time) {
        $sql = 'SELECT * FROM schedules WHERE time=:time';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':time', $time, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // получить расписание по дате
    public function scheduleGetByDate($day, $month, $year) {
        $sql = 'SELECT * FROM schedules WHERE day = :day AND month = :month AND year = :year';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':day', $day, PDO::PARAM_INT);
        $stm->bindValue(':month', $month, PDO::PARAM_INT);
        $stm->bindValue(':year', $year, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // получить расписание по фильтру
    public function scheduleGetByFilter($arFilter) {

        $filter = '';

        foreach ($arFilter as $key => $value) {
            if($filter === '') {
                $filter = $key . '= :' . $key;
            } else {
                $filter .= ' AND ' . $key . '= :' . $key;
            }
        }

        $sql = 'SELECT * FROM schedules WHERE ' . $filter;
        $stm = $this->connection->prepare($sql);


        foreach ($arFilter as $key => $value) {
            $stm->bindValue(':' . $key, $value, PDO::PARAM_INT);
        }


        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // выбрать расписание
    public function chooseSchedule($options) {

    }


    // получить всех мастеров
    public function getMasters() {
        $sql = 'SELECT * FROM masters';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // получить мастера
    public function getMasterById($master_id) {
        $sql = 'SELECT * FROM masters WHERE id = :master_id';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':master_id', $master_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchObject('stdClass');
    }


    // получить все услуги
    public function getServices() {
        $sql = 'SELECT * FROM services';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // получить мастера
    public function getServicesByMasterId($master_id) {
        $sql = 'SELECT MA.id, MA.master_id, MA.service_id, S.name, S.price, S.time 
        FROM masters_services as MA, services as S 
        WHERE MA.master_id = :master_id AND S.id = MA.service_id';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':master_id', $master_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }






    //Создать пользователя
    public function saveUser($options) {
        $name = $options['name'];
        $login = $options['login'];
        $password = $options['password'];
        $sql = "INSERT INTO user (name, login, password) VALUES (:name, :login, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $res = $stmt->execute();
        return $res;
    }
    // Создать тело питона
    public function createSnakeBody($options) {
        $snake_id = $options->snake_id;
        $x = $options->x;
        $y = $options->y;

        $sql = "INSERT INTO snake_body (snake_id, x, y) VALUES (:snake_id, :x, :y)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':snake_id', $snake_id, PDO::PARAM_INT);
        $stmt->bindParam(':x', $x, PDO::PARAM_INT);
        $stmt->bindParam(':y', $y, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $res;
    }
    // текущее время на сервере
    public function getServerTime() {
        $sql = 'SELECT UNIX_TIMESTAMP() AS time';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchObject('stdClass');

    }
    // Удалить часть тела питона
    public function deleteSnakeBodyFromSnake($id) {
        $sql = "DELETE FROM snake_body WHERE snake_id =  :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $res;
    }



    // Изменить токен пользователя
    public function updateUserToken($id, $token) {
        $sql = "UPDATE user SET token = :token WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
    