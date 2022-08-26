<script>
    $(document).ready(function() {
        var interval_close = setInterval(closeSideBar, 250);

        function closeSideBar() {
            $("#hide-sub-menus").click();
            clearInterval(interval_close);
        }
    });
</script>
<style type="text/css">
    th,
    td {
        white-space: nowrap;
    }

    div.dataTables_wrapper {
        margin: 0 auto;
    }

    #table-luar {
        font-size: 11px;
    }

    #filter {
        border-spacing: 10px;
        border-collapse: separate;
    }

    .td-fixed {
        width: 30px;
    }

    .td-no {
        width: 10px;
    }

    .ddl {
        width: 100px;
        height: 30px;
    }

    .ddl2 {
        width: 180px;
        height: 30px;
    }
</style>

<aside class="right-side">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/basis/home_c') ?>"><span>Home</span></a></li>
            <li><a href="#"><strong>Download SPKL</strong></a></li>
        </ol>
    </section>

    <section class="content">
        <?php
        if ($msg != NULL) {
            echo $msg;
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="grid">
                    <div class="grid-header">
                        <i class="fas fa fa-solid fa-download"></i>
                        <span class="grid-title"><strong>DOWNLOAD SPKL</strong></span>
                        <div class="pull-right grid-tools">
                            <a href="<?php echo base_url('index.php/aorta/overtime_c/create_overtime/' . $period . '/' . $dept . '/' . $section) ?>" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Download All" style="height:30px;font-size:13px;width:110px;padding-left:10px;">Download All</a>
                            

                        </div>
                    </div>
                    <div class="grid-body">
                        <div class="pull">
                            <table width="100%" id='filter'>
                                <tr>
                                    
                                    </td>
                                    <td width="10%" style='text-align:left;' colspan="4">
                                       
                                    </td>

                                    <td width="50%">

                                    </td>
                                    <td width="10%">
                                    </td>
                            </table>
                        </div>
                        <div id="table-luar">
                            <table id="dataTables3" class="table table-condensed  table-striped table-hover display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;text-align:center;">Reference No</th>
                                        <th style="vertical-align: middle;text-align:center;">Employee ID</th>
                                        <th style="vertical-align: middle;text-align:center;">Overtime Date</th>
                                        <th style="vertical-align: middle;text-align:center;">Reference Date</th>
                                        <th style="vertical-align: middle;text-align:center;">Overtime In Date</th>
                                        <th style="vertical-align: middle;text-align:center;">Overtime In Time</th>
                                        <th style="vertical-align: middle;text-align:center;">Overtime Out Date</th>
                                        <th style="vertical-align: middle;text-align:center;">Overtime Out Time</th>
                                        <th style="vertical-align: middle;text-align:center;">Remark</th>

                                        <th style="vertical-align: middle;text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_download as $isi) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;text-align:center;" ><?= $isi->NO_SEQUENCE ?></td>
                                            <td style="vertical-align: middle;text-align:center;">
                                                <a class= "btn btn-primary" href="<?php echo base_url('view_spkl/manage_view_spkl_v/') ?>" <i class=""></i>Show</a>
                                                <a class= "btn btn-success" href="<?php echo base_url('download_spkl_c/excel') ?>" <i class=""></i>Download</a>
                                            </td>
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                    
                                    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>




            </div>
        </div>

    </section>
</aside>

<script src="<?php echo base_url('assets/js/jquery-1.12.3.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.fixedColumns.min.js') ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/fixedColumns.dataTables.min.css'); ?>">
<script>
    //                                             $(document).ready(function () {
    //                                                 var table = $('#example').DataTable({
    //                                                     scrollY: "350px",
    //                                                     scrollX: true,
    //                                                     scrollCollapse: true,
    //                                                     paging: true,
    //                                                     fixedColumns: {
    //                                                         leftColumns: 4
    //                                                     }
    //                                                 });

    // //                                                    $('.dataTables_filter input').addClass('search-query');
    //                                                 $('.dataTables_filter input').attr('placeholder', 'Search');
    //                                             });
</script>