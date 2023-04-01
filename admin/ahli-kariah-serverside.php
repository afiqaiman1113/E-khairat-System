<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    include_once 'header_user.php';
}
?>
<br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Ahli Kariah</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No</th>
                                            <th style="font-size:90%;">No Ahli</th>
                                            <th style="font-size:90%;">Nama</th>
                                            <th style="font-size:90%;">Kariah</th>
                                            <th style="font-size:90%;">Tarikh Daftar</th>
                                            <th style="font-size:90%;">Status K.Kematian</th>
                                            <th style="font-size:90%;">Status Bayaran</th>
                                            <th style="font-size:90%;">Status Ahli</th>
                                            <th style="font-size:90%;">Status SMS</th>
                                            <th style="font-size:90%;">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$nilai = 0;
?>

<script>
    $(document).ready(function() {
        var table = $('#producttable').DataTable({
            "order": [
                [0, ""]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": "fetchDataAhli.php?nilai=<?= $nilai; ?>",


            "columnDefs": [{
                targets: -1,
                data: null,
                defaultContent: "<button type='button' class='btn btn-info btn-sm dropdown-toggle dropdown-icon' data-toggle='dropdown'>Lanjut<span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><button type='button' class='dropdown-item semak_data'><span class='fas fa-eye text-dark'></span> Semak</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item bayar_tunai'><span class='fa fa-money-bill-wave-alt'></span> Bayar Tunai</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item tuntut_ahli'><span class='fas fa-user'></span> Tuntut Ahli</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item tuntut_tanggungan'><span class='fas fa-users'></span> Tuntut Tanggungan</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item pindah_kariah'><span class='fa fa-map-marker-alt'></span> Pindah Kariah</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item deleteUser' id='deleteUser'><span class='fas fa-trash text-danger'></span> Hapus</button>",
            }]
        });

        table.on('draw.dt', function() {
            var info = table.page.info();
            table.column(0, {
                search: 'applied',
                order: 'applied',
                page: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

        $('#producttable tbody').on('click', '.semak_data', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.location.href = "semak-ahli-kariah.php?kariah_id=" + data[0];
        });

        $('#producttable tbody').on('click', '.bayar_tunai', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.location.href = "bayar-tunai-najmi.php?kariah_id=" + data[0];
        });

        $('#producttable tbody').on('click', '.tuntut_ahli', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.location.href = "tuntut.php?kariah_id=" + data[0];
        });

        $('#producttable tbody').on('click', '.tuntut_tanggungan', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.location.href = "tuntut-tanggungan.php?kariah_id=" + data[0];
        });

        $('#producttable tbody').on('click', '.pindah_kariah', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.location.href = "telah-pindah.php?kariah_id=" + data[0];
        });

        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
        });

        $("#producttable tbody").on("click", ".deleteUser, .btndelete", function(e) {
            e.preventDefault();
            var data, id, tdh;
            if ($(this).hasClass("deleteUser")) {
                data = table.row($(this).parents("tr")).data();
                id = data[0];
            } else if ($(this).hasClass("btndelete")) {
                tdh = $(this);
                id = $(this).attr("id");
            }
            swal({
                title: "Anda Pasti?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "delete_ahli_kariah.php?kariah_id=" + id,
                        success: function(message) {
                            if (message == "Success") {
                                swal({
                                    title: "Berjaya Padam",
                                    // text: "Congratulation Delete Success",
                                    icon: "success",
                                    button: "OK",
                                });
                                if (tdh) {
                                    tdh.parents('tr').hide();
                                } else {
                                    table.ajax.reload();
                                }
                            } else {
                                swal({
                                    title: "Gagal Padam",
                                    // text: "Please Check Your Form Again",
                                    icon: "warning",
                                    dangerMode: true,
                                    button: "OK",
                                });
                            }
                        },
                    });
                } else {
                    swal("Data tidak akan dipadamkan");
                }
            });
        });
    });
</script>

<?php
include_once 'footer.php';
?>