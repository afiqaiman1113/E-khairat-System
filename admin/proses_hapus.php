<?php

    include_once "database/connect.php";
    if (isset($_POST['khairat_id'])) {
        $khairat_id = $_POST['khairat_id'];
        $sql = "DELETE khairat_kematian FROM khairat_kematian WHERE khairat_kematian.khairat_id = $khairat_id ";
        $delete = $pdo->prepare($sql);
        if ($delete->execute()) {
        } else {
            echo 'Error';
        }
    }

