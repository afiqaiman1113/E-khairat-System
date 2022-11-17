<div class="main-panel">
    <div class="content" style="margin-top: 60px">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card">
                                <div class="card-header">
                                    <h3 class="card-title">Bayaran Online (FPX)</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" name="">
                                        <input type="hidden" name="status_id" class="form-control" placeholder="" value="0" />
                                        <td style="display:none;">
                                            <!--<input type="hidden" name="product_name[]" class="form-control pname" placeholder="" readonly />-->
                                        </td>
                                        <td>
                                            <label>Yuran (Boleh pilih lebih dari satu)</label><br>
                                            <select name="product_id[]" style="width: 250px" class="form-control productid" multiple required="" oninvalid="this.setCustomValidity('Pilih Yuran')" oninput="setCustomValidity('')">
                                                <?php
                                                echo fill_product($pdo);
                                                ?>
                                            </select>
                                        </td>
                                        <p style="color:red;">*Setiap transaksi akan dicas RM1.00</p>
                                        <td><input type="hidden" name="jumlah" class="form-control jumlah" placeholder="" readonly /></td>
                                        <td><input type="hidden" name="quantity" class="form-control quantity" placeholder="" /></td>
                                        <td><input type="hidden" name="total" class="form-control total" placeholder="" readonly /></td>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                RM
                                                            </span>
                                                        </div>
                                                        <input type="text" name="total" class="form-control" id="total" placeholder="" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Bayar</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                RM
                                                            </span>
                                                        </div>
                                                        <input type="number" name="paid" class="form-control" id="paid" placeholder="" required="" oninvalid="this.setCustomValidity('Masukkan jumlah')" oninput="setCustomValidity('')" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="due" class="form-control" id="due" placeholder="" readonly />
                                        <!-- input form -->
                                        <input name="invoice_no" type="hidden" class="form-control" value="<?php $b = rand(10, 10000);
                                                                                                            $c = $b;
                                                                                                            echo $c; ?>" autofocus="on" readonly="readonly" />
                                        <input type="hidden" name="p_method" class="form-control" placeholder="" value="FPX" />
                                        <input type="hidden" name="stat" class="form-control" />
                                        <hr>
                                        <div align="center">
                                            <input type="submit" name="btn_simpan" value="BAYAR GUNA FPX" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card">
                                <div class="card-header" style="background-color: #FF0000;">
                                    <h3 class="card-title" style="color:White">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Penting
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert alert-dismissible">
                                        <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                        <ul>
                                            <li>Pastikan anda telah mengemaskini maklumat terlebih dahulu sebelum melakukan pembayaran</li><br>
                                            <li>Maklumat pada penyata/resit bayaran tidak boleh dikemaskini setelah melakukan pembayaran</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include_once 'footer2.php'; ?>
</div>
<!-- <script>
    $(document).ready(function() {

        $('#member-list').DataTable({
            "order": [
                [0, "asc"]
            ] //tutorial tu kata dia akan table dalam desc order
        });

        $('.productid').select2()
        $('.productid').select2({
            theme: 'bootstrap4'
        })

        $('.productid').on('change', function(e) {
            //var productid = this.value;
            var productid = $(".productid").val();

            var tr = $(this).parent().parent();
            $.ajax({
                url: "getproduct2.php",
                method: "get",
                data: {
                    id: productid
                },
                success: function(data) {
                    tr.find(".pname").val(data["product_name"]);
                    tr.find(".jumlah").val(data["jumlah"]);
                    tr.find(".quantity").val(1);
                    tr.find(".total").val(tr.find(".quantity").val() * tr.find(".jumlah").val());
                    calculate(0, 0);
                }
            })
        })

        function calculate(paid) {
            var net_total = 0;
            var paid_amount = paid;
            var due = 0;

            $(".total").each(function() {
                net_total = net_total + ($(this).val() * 1);
            })

            $(".paid").each(function() {
                net_total = net_total + ($(this).val() * 1);
            })

            net_total = net_total;
            paid_amount = net_total;
            due = net_total - paid_amount;
            $("#total").val(net_total.toFixed(2));
            $("#paid").val(net_total.toFixed(2));
            $("#due").val(due.toFixed(2));
        }

        $("#paid").keyup(function() {
            var paid = $(this).val();
            calculate(paid);
        })
    });
</script> -->