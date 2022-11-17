$(document).ready(function () {
  // Setup Ajax
  $.ajax({
    type: "POST",
    cache: false,
    // data: new FormData(this),
    contentType: false,
    processData: false,
  });
  // To Validation If Got An Error
  function validasi(text_value) {
    return swal({
      title: "Oops You're Got An Error !!!",
      text: "The Field " + text_value + " Cannot Be Empty",
      icon: "warning",
      dangerMode: true,
      button: "Continue Filling Out",
    });
  }

  // DataTables Server Side For Books
  table_categories = $("#tableCategories").DataTable({
    oLanguage: {
      sLengthMenu: "Tampilkan _MENU_ Data Per Halaman",
      sSearch: "Pencarian Data",
      sZeroRecords: "Maaf Tidak Ada Data Yang Ditemukan",
      sInfo: "Menampilkan _START_ s/d _END_ Dari _TOTAL_ Data",
      sInfoEmpty: "Menampilkan 0 s/d 0 Dari 0 Data",
      sInfoFiltered: "(Di Filter Dari _MAX_ Total Data)",
      oPaginate: {
        sFirst: "<<",
        sLast: ">>",
        sPrevious: "Kembali",
        sNext: "Lanjut",
      },
    },
    sPaginationType: "full_numbers",
    bJqueryUI: true,
    processing: true,
    serverSide: true,
    ajax: "datatable.php",
    fnCreatedRow: function (row, data, index) {
      $("td", row)
        .eq(0)
        .html(index + 1);
    },
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          //   "<button type='button' class='btn btn-success btn-sm updateCategory' data-target='#update' data-toggle='modal'><i class='mdi mdi-pencil-box'></i>Edit</button> <button type='button' class='btn btn-danger btn-sm deleteCategory' id='deleteCategory'><i class='mdi mdi-delete'></i>Hapus</button>",
          "<button type='button' class='btn btn-info btn-sm dropdown-toggle dropdown-icon' data-toggle='dropdown'>Lanjut<span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a href='#'  class='dropdown-item  updateCategory' data-target='#update' data-toggle='modal'><i class='fas fa-edit'></i>Kemaskini</a><div class='dropdown-divider'></div><button type='button' class='dropdown-item deleteUser' id='deleteUser'><span class='fas fa-trash text-danger'></span>Hapus</button>",
      },
    ],
  });

  // Then Button Edit Book On Click
  $("#tableCategories tbody").on("click", ".updateCategory", function () {
    var data = table_categories.row($(this).parents("tr")).data();
    // window.location.href = "edit.php?id="+ data[4];
    $("#product_name_update").val(data[1]);
    $("#jumlah_update").val(data[2]);
    $("#tahun_update").val(data[3]);
    $("#id_update").val(data[4]);
  });

  // Form Book Update
  $("#updateCategory").on("submit", function (e) {
    e.preventDefault();
    var nama = $("#product_name_update").val();
    var email = $("#jumlah_update").val();
    var user = $("#tahun_update").val();
    if (nama == "") {
      validasi("Nama Yuran");
    } else if (email == "") {
      validasi("Jumlah");
    } else if (user == "") {
      validasi("Tahun");
    } else {
      $.ajax({
        url: "update_action.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (message) {
          if (message == "Success") {
            swal({
              title: "Success",
              text: "Congratulation Form Update Success",
              icon: "success",
              button: "Done",
            });
            $(".close").click();
            table_categories.ajax.reload();
          } else {
            swal({
              title: "Oops, You're Got An Error !!!",
              text: "Please Check Your Form Again",
              icon: "warning",
              dangerMode: true,
              button: "Check",
            });
          }
        },
      });
    }
  });

  // Form Book Delete
  $("#tableCategories tbody").on("click", ".deleteUser", function (e) {
    e.preventDefault();
    var data_id = table_categories.row($(this).parents("tr")).data();
    swal({
      title: "Are you sure?",
      text: "Delete Data With Category " + data_id[1],
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "delete_action.php?product_id=" + data_id[0],
          success: function (message) {
            if (message == "Success") {
              swal({
                title: "Success",
                text: "Congratulation Delete Success",
                icon: "success",
                button: "Done",
              });

              table_categories.ajax.reload();
            } else {
              swal({
                title: "Oops, You're Got An Error !!!",
                text: "Please Check Your Form Again",
                icon: "warning",
                dangerMode: true,
                button: "Check",
              });
            }
          },
        });
      } else {
        swal("Your Data Not Be Deleted :)");
      }
    });
  });
});
