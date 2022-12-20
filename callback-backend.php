<?php
include_once 'admin/database/connect.php';

include_once 'header-test.php';

if (isset($_POST['status'])) {

    $status = $_POST['status'];
    $order_id = $_POST['order_id'];

    $select = $pdo->prepare("SELECT * FROM khairat_kematian WHERE khairat_id  = $order_id");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    $khairat_id = $row['khairat_id'];
    $kariah_id = $row['kariah_id'];
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $jumlah = $row['jumlah'];
    $quantity = $row['quantity'];
    $expired = $row['expired'];
    $tarikh_bayar = date('d-m-Y', strtotime($row['tarikh_bayar']));
    $total = $row['total'];
    $paid = $row['paid'];
    $due = $row['due'];

    $update_kariah = $pdo->prepare("UPDATE khairat_kematian SET status_id=:status_id WHERE khairat_id = $order_id");
    $update_kariah->bindParam(':status_id', $status);
    $update_kariah->execute();

    if ($status == 1) {
        $sql = "UPDATE ahli_kariah SET approvement = 'Telah Daftar', tarikh_expired = '$expired', status_sms = 2 WHERE kariah_id = $kariah_id ";
        $update = $pdo->prepare($sql);
        $update->execute();

        $select = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_id = $kariah_id");
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
        $tel_hp = $row['tel_hp'];

        $form_data = [
            'token_uid' => "746210583",
            'token_key' => "utwe2qsd5r7acgvx8ozi",
            'receipients' => $tel_hp,
            'message' => "Tq bayar"
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://sms.ala.my/api/v1/send');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
        $result = curl_exec($curl);
        $obj = json_decode($result);
    }
}
?>