<?php
include_once 'database/connect.php';
session_start();
if ($_SESSION['user_id'] == "" or $_SESSION['role'] == "User") {
    header('Location: index.php');
}
if ($_SESSION['role'] == "Admin") {
    include_once 'header.php';
} else {
    '';
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
                            <div id="table" style="overflow-x: auto;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    function table() {
        //   const xhttp = new XMLHttpRequest();
        //   xhttp.onload = function() {
        //     document.getElementById("table").innerHTML = this.responseText;
        //   }
        //   xhttp.open("GET", "ahli-kariah-table.php");
        //   xhttp.send();
        //var oTable = $('#producttable').dataTable();
        var tableApi = $('#producttable').DataTable();

        $.ajax({

            url: "ahli-kariah-table.php",
            success: function(data) {
                var info = tableApi.page.info();
                //console.log(info);
                //console.log(info.page);
                document.getElementById("table").innerHTML = data;
                tableApi = $('#producttable').DataTable({
                    "order": [
                        [0, "dsc"]
                    ]
                });
                //console.log(info.page);
                tableApi.page(info.page).draw('page');

                //oTable.fnPageChange(3);
            }
        });

    }

    setInterval(function() {
        table();
        //kalau hg comment table ni, maka realtime data takkan berfungsi, malah untuk modal tambah penama berfungsi dgn baik
    }, 10000);


    $(document).ready(function() {
        table();
        //var tableApi = $('#producttable').DataTable();

    });

    $(document).on("click", '.btndelete', function(event) {
        var tdh = $(this);
        var id = $(this).attr("id");

        swal({
                title: "Anda Pasti?",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'kariahdelete.php',
                        type: 'post',
                        data: {
                            pidd: id
                        },
                        success: function(data) {
                            tdh.parents('tr').hide();
                        }
                    })
                    swal("Berjaya padam", {
                        icon: "success",
                    });
                } else {
                    // swal("Your imaginary file is safe!");
                }
            });
    });

    // $(document).ready(function() {
    //     $('#producttable').on('click', '.btndelete', function() {
    //         var tdh = $(this);
    //         var id = $(this).attr("id");

    //         swal({
    //                 title: "Anda Pasti?",
    //                 // text: "Once deleted, you will not be able to recover this imaginary file!",
    //                 icon: "warning",
    //                 buttons: true,
    //                 dangerMode: true,
    //             })
    //             .then((willDelete) => {
    //                 if (willDelete) {
    //                     $.ajax({
    //                         url: 'kariahdelete.php',
    //                         type: 'post',
    //                         data: {
    //                             pidd: id
    //                         },
    //                         success: function(data) {
    //                             tdh.parents('tr').hide();
    //                         }
    //                     })
    //                     swal("Berjaya padam", {
    //                         icon: "success",
    //                     });
    //                 } else {
    //                     // swal("Your imaginary file is safe!");
    //                 }
    //             });
    //     });
    // });
</script>

<?php
include_once 'footer.php';
?>