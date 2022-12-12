<?php
# create database connection
include_once 'database/connect.php';



// $penama_ic = $_POST['penama_ic'];

if (!empty($_POST["kariah_ic"])) {

    $query = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_ic='" . $_POST["kariah_ic"] . "'");
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "<span style='color:red'> No KP telah wujud</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> No KP Boleh Digunakan</span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
} elseif (!empty($_POST["tel_hp"])) {

    $select_tel_hp = $pdo->prepare("SELECT * FROM ahli_kariah WHERE tel_hp='" . $_POST["tel_hp"] . "'");
    $select_tel_hp->execute();

    if ($select_tel_hp->rowCount() > 0) {
        echo "<span style='color:red'> No Tel Kariah telah wujud</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> No Tel Boleh Digunakan</span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
} elseif (!empty($_POST["penama_no"])) {

    $select_tel_penama = $pdo->prepare("SELECT * FROM penama WHERE penama_no='" . $_POST["penama_no"] . "'");
    $select_tel_penama->execute();

    if ($select_tel_penama->rowCount() > 0) {
        echo "<span style='color:red'> No Tel Penama telah </span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> No Tel Boleh Digunakan</span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
} elseif (!empty($_POST["user_email"])) {

    $select_email = $pdo->prepare("SELECT * FROM ahli_kariah WHERE user_email='" . $_POST["user_email"] . "'");
    $select_email->execute();

    if ($select_email->rowCount() > 0) {
        echo "<span style='color:red'> Emel telah wujud</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> Emel Boleh Digunakan</span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
} elseif (!empty($_POST["penama_ic"])) {

    $query1 = $pdo->prepare("SELECT * FROM penama WHERE penama_ic='" . $_POST["penama_ic"] . "'");
    $query1->execute();

    if ($query1->rowCount() > 0) {
        echo "<span style='color:red'> No KP Penama telah wujud</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> No KP Penama Boleh Digunakan</span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
} elseif (!empty($_POST["penama_email"])) {

    $query2 = $pdo->prepare("SELECT * FROM penama WHERE penama_email='" . $_POST["penama_email"] . "'");
    $query2->execute();

    if ($query2->rowCount() > 0) {
        echo "<span style='color:red'> Emel Telah Wujud</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> Emel Boleh Digunakan</span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["kariah_ic"])) {

    $query3 = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_ic='" . $_POST["kariah_ic"] . "'");
    $query3->execute();


    $sql = "SELECT * FROM penama WHERE penama_ic = :penama_ic ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':penama_ic', $_POST["kariah_ic"]);
    $stmt->execute();
    $penama = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($penama > 0) {
        echo "<span style='color:red'> Tetapi Sama Dengan No K/P Penama</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } elseif ($query3->rowCount() > 0) {
        echo "<span style='color:red'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}

// if (!empty($_POST["kariah_ic"])) {

//     $testing = !empty($_POST["kariah_ic"]);

//     $query6 = $pdo->prepare("SELECT * FROM ahli_kariah WHERE kariah_ic='" . $_POST["kariah_ic"] . "'");
//     $query6->execute();

//     $query5 = $pdo->prepare("SELECT * FROM penama WHERE penama_ic= $testing ");
//     $query5->execute();

//     if ($query6 == $query5) {
//         echo "<span style='color:red'> Sama wei</span>";
//         echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
//     } else {
//         echo "<span style='color:green'>Tak sama wei</span>";
//         echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
//     }
// }

if (!empty($_POST["user_email"])) {

    $select_email1 = $pdo->prepare("SELECT * FROM ahli_kariah WHERE user_email='" . $_POST["user_email"] . "'");
    $select_email1->execute();

    $sql = "SELECT * FROM penama WHERE penama_email = :penama_email ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':penama_email', $_POST["user_email"]);
    $stmt->execute();
    $penamaemail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($penamaemail > 0) {
        echo "<span style='color:red'> Tetapi Sama Dengan Emel Penama</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } elseif ($select_email1->rowCount() > 0) {
        echo "<span style='color:red'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["penama_ic"])) {

    $query = $pdo->prepare("SELECT * FROM penama WHERE penama_ic='" . $_POST["penama_ic"] . "'");
    $query->execute();

    $ic = $pdo->prepare("SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = :kariah_ic");
    $ic->bindParam(':kariah_ic', $_POST["penama_ic"]);
    $ic->execute();
    $i = $ic->fetch();

    if ($i > 0) {
        echo "<span style='color:red'> Tetapi Sama Dengan IC Ahli</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } elseif ($query->rowCount() > 0) {
        echo "<span style='color:red'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["penama_email"])) {

    $user_email = $_POST["penama_email"];

    $query = $pdo->prepare("SELECT * FROM penama WHERE penama_email='" . $_POST["penama_email"] . "'");
    $query->execute();

    $email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email ='$user_email' ");
    $email->execute([$user_email]);
    $em = $email->fetch();

    if ($em > 0) {
        echo "<span style='color:red'> Tetapi Sama Dengan Emel Ahli</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } elseif ($query->rowCount() > 0) {
        echo "<span style='color:red'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["tel_hp"])) {

    $tel_hp_penama = $_POST["tel_hp"];

    $select_tel_hp = $pdo->prepare("SELECT * FROM ahli_kariah WHERE tel_hp='" . $_POST["tel_hp"] . "'");
    $select_tel_hp->execute();

    $telhp = $pdo->prepare("SELECT penama_no FROM penama WHERE penama_no ='$tel_hp_penama' ");
    $telhp->execute([$tel_hp_penama]);
    $tel = $telhp->fetch();

    if ($tel > 0) {
        echo "<span style='color:red'> Tetapi Sama Dengan No Tel Penama</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } elseif ($select_tel_hp->rowCount() > 0) {
        echo "<span style='color:red'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}

if (!empty($_POST["penama_no"])) {

    $tel_hp_ahli = $_POST["penama_no"];

    $select_tel_penama = $pdo->prepare("SELECT * FROM penama WHERE penama_no='" . $_POST["penama_no"] . "'");
    $select_tel_penama->execute();

    $telpenama = $pdo->prepare("SELECT tel_hp FROM ahli_kariah WHERE tel_hp ='$tel_hp_ahli' ");
    $telpenama->execute([$tel_hp_ahli]);
    $tel_penama = $telpenama->fetch();

    if ($tel_penama > 0) {
        echo "<span style='color:red'> Tetapi Sama Dengan No Tel Ahli</span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } elseif ($select_tel_penama->rowCount() > 0) {
        echo "<span style='color:red'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btn_simpan').prop('disabled',false);</script>";
    }
}
