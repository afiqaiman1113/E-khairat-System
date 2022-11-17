<?php
include_once 'database/connect.php';

$select = $pdo->prepare("SELECT * FROM ahli_kariah");
$select->execute();
while ($row = $select->fetch(PDO::FETCH_OBJ)) {
    $tel_hp = $row->tel_hp;
    if (strtotime(date("d-m-Y")) == strtotime($row->tarikh_expired)) {
        $form_data = [
            'token_uid' => "746210583",
            'token_key' => "utwe2qsd5r7acgvx8ozi",
            'receipients' => $tel_hp,
            'message' => "Masjid Al-Wustha: Sila renew"
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://sms.ala.my/api/v1/send');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $form_data);
        $result = curl_exec($curl);
        $obj = json_decode($result);
        $update_kariah = $pdo->prepare("UPDATE ahli_kariah SET status_sms=1 WHERE kariah_id = $id");
        $update_kariah->execute();
    }
}
?>