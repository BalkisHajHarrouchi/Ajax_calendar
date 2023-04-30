<?php
$connect = new PDO("mysql:host=localhost;dbname=fullcalendar;","root","");
$data = array();
$query = "SELECT * from events";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row) {
    $data[] = array(
        "id" => $row["id"],
        "title" => $row["title"],
        "start" => $row["start_event"],
        "end" => $row["end_event"]
    );
}
//json format
echo json_encode($data);
?>