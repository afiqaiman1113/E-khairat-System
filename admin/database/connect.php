<?php

//guna method try catch. Tujuannya untuk exception handling (utk atasi error)

try {
//bawah ni adalah syntax cara nak connect dgn db guna PDO method. Kalu cara yg standard, boleh tgk yt je banyak tuto
$pdo = new PDO('mysql:host=localhost;dbname=khairat' , 'root', '');

} catch(PDOException $f){
    echo $f->getMessage();
}

?>