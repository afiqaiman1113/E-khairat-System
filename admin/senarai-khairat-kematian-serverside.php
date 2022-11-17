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
                            <h3 class="card-title">Senarai Bayaran Khairat Kematian</h3>
                        </div> <br>
                        <div class="col-md-12">
                            <div style="overflow-x: auto;">
                                <table id="producttable" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size:90%;">No</th>
                                            <th style="font-size:90%;">Nama</th>
                                            <th style="font-size:90%;">Jenis Bayaran</th>
                                            <th style="font-size:90%;">Tarikh Bayar</th>
                                            <th style="font-size:90%;">Jumlah</th>
                                            <th style="font-size:90%;">Bayar</th>
                                            <th style="font-size:90%;">Baki</th>
                                            <!-- <th style="font-size:90%;">Kawasan Ahli Kariah</th> -->
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

<?php include('view_modal.php'); ?>

<?php
// Kondisi Pilihan data yg tampil
// jika bernilai 1 maka akan tampil kelas One dan jika bernilai 0 yg akan tampil data kelas zerro
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
            "ajax": "fetchData.php?nilai=<?= $nilai; ?>",


            "columnDefs": [
                {
                    "targets": 4,
                    "render": $.fn.dataTable.render.number(',', '.', '2', 'RM ')

                },

                {
                    "targets": 5,
                    "render": $.fn.dataTable.render.number(',', '.', '2', 'RM ')

                },
                {
                    "targets": 6,
                    "render": $.fn.dataTable.render.number(',', '.', '2', 'RM ')

                },
                {
                    targets: -1,
                    data: null,
                    defaultContent:
                        //   "<button type='button' class='btn btn-success btn-sm updateCategory' data-target='#update' data-toggle='modal'><i class='mdi mdi-pencil-box'></i>Edit</button> <button type='button' class='btn btn-danger btn-sm deleteCategory' id='deleteCategory'><i class='mdi mdi-delete'></i>Hapus</button>",
                        "<button type='button' class='btn btn-info btn-sm dropdown-toggle dropdown-icon' data-toggle='dropdown'>Lanjut<span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><button type='button' class='dropdown-item viewCategory' data-target='#view' data-toggle='modal'><span class='fas fa-eye text-dark'></span> Lihat Butiran</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item edit_data'><span class='fa fa-edit text-primary'></span> Kemaskini Bayaran</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item print_data'><span class='fas fa-print text-warning'></span> Cetak</button><div class='dropdown-divider'></div><button type='button' class='dropdown-item deleteUser' id='deleteUser'><span class='fas fa-trash text-danger'></span> Hapus</button>",
                }
            ]
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

        $('#producttable tbody').on('click', '.edit_data', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.location.href = "semakan-bayaran.php?khairat_id=" + data[0];
        });
        $("#producttable tbody").on("click", ".viewCategory", function() {
            var data = table.row($(this).parents("tr")).data();
            // window.location.href = "edit.php?id="+ data[4];
            $("#kariah_name_update").val(data[1]);
            $("#kariah_ic_update").val(data[7]);
            $("#kawasan_update").val(data[8]);
            $("#product_id_update").val(data[2]);
            $("#tarikh_bayar_update").val(data[3]);
            $("#expired_update").val(data[9]);
            $("#total_update").val(data[4]);
            $("#paid_update").val(data[5]);
            $("#due_update").val(data[6]);
            $("#p_method_update").val(data[10]);
            $("#invoice_no_update").val(data[11]);
            $("#approvement_update").val(data[12]);
            $("#khairat_id_update").val(data[0]);
        });

        $('#producttable tbody').on('click', '.print_data', function() {
            var data = table.row($(this).parents('tr')).data();
            // var data3 = data[0];
            // var data3 = btoa(data3);
            window.open("penyata-khairat.php?khairat_id=" + data[0], '_blank');
        });

        $.ajax({
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
        });

        $("#producttable tbody").on("click", ".deleteUser", function(e) {
            e.preventDefault();
            var data = table.row($(this).parents("tr")).data();
            swal({
                title: "Anda Pasti?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "delete_khairat.php?khairat_id=" + data[0],
                        success: function(message) {
                            if (message == "Success") {
                                swal({
                                    title: "Berjaya Padam",
                                    // text: "Congratulation Delete Success",
                                    icon: "success",
                                    button: "OK",
                                });

                                table.ajax.reload();
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


    $(document).ready(function() {
        $('#penama_ic').mask('000000-00-0000');
    });
</script>


<?php
include_once 'footer.php';
?>