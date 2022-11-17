<?php
class Model
{

    public function fetch()
    {
        include_once 'database/connect.php';
        $data = [];
        $query = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 ORDER BY khairat_id DESC");
        //$select = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE status_id = 1 ORDER BY khairat_id DESC ");
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function date_range($date1, $date2)
    {
        include_once 'database/connect.php';
        $data = [];

        if (isset($date1) && isset($date2)) {
            $query = $pdo->prepare("SELECT * FROM khairat_kematian INNER JOIN ahli_kariah ON khairat_kematian.kariah_id = ahli_kariah.kariah_id JOIN tbl_product ON tbl_product.product_id = khairat_kematian.product_id WHERE `tarikh_bayar` >= '$date1' AND `tarikh_bayar` <= '$date2'");
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}


