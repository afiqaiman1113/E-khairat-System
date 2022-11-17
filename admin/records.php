<?php

include 'model.php';

$model = new Model();

if (isset($_POST['date1']) && isset($_POST['date2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $rows = $model->date_range($date1, $date2);
} else {
    $rows = $model->fetch();
}

echo json_encode($rows);