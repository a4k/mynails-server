<?php

class DB {

    private $connection;

    public function __construct($TYPE) {

        if($TYPE === 'DEV') {
            $host = '192.168.0.100';
            $dbName = 'mynails';
            $user = 'root';
            $pass = '';
        } else {
            $host = 'localhost';
            $dbName = 'h99918lb_mynails';
            $user = 'h99918lb_mynails';
            $pass = 'e123456';
        }
        $this->connection = new PDO('mysql:dbname=' . $dbName . ';host=' . $host, $user, $pass);
    }





    // Получить конкретное расписание по ID
    public function scheduleDetail($schedule_id){
        $sql = 'SELECT * from schedules WHERE id=:schedule_id'; //SQl запрос
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':schedule_id', $schedule_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchObject('stdClass');
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



    // получить всех мастеров
    public function masterAll() {
        $sql = 'SELECT * FROM masters';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }

    // получить мастера
    public function masterDetail($master_id) {
        $sql = 'SELECT * FROM masters WHERE id = :master_id';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':master_id', $master_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchObject('stdClass');
    }

    // получить услуги мастера
    public function masterServices($master_id) {
        $sql = 'SELECT MA.id, MA.master_id, MA.service_id, S.name, S.price, S.time 
        FROM masters_services as MA, services as S 
        WHERE MA.master_id = :master_id AND S.id = MA.service_id';
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':master_id', $master_id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }



    // получить все услуги
    public function serviceAll() {
        $sql = 'SELECT * FROM services';
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS);
    }





    // Создание заказа
    public function orderCreate($schedule_id, $name, $phone) {

        $sql = "INSERT INTO orders (schedule_id, name, phone) VALUES (:schedule_id, :name, :phone)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

        $res = $stmt->execute();
        return $res;
    }





    // Обновить статус расписания
    public function scheduleUpdateStatus($schedule_id, $status) {
        $sql = "UPDATE schedules SET status = :status WHERE id = :schedule_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':schedule_id', $schedule_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
    