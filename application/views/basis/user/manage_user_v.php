<aside class="right-side">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/basis/home_c') ?>"><span>Home</span></a></li>
            <li><a href="<?php echo base_url('index.php/basis/user_c') ?>"><strong>Manage Employee</strong></a></li>
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
                        <i class="fa fa-user"></i>
                        <span class="grid-title"><strong>EMPLOYEE</strong> TABLE</span>
                        <div class="pull-right">
                            <a href="<?php echo base_url('index.php/basis/user_c/create_user/') ?>"  class="btn btn-default" data-placement="left" data-toggle="tooltip" title="Create Employee" style="height:30px;font-size:13px;width:100px;">Create</a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <table id="dataTables1" class="table table-striped table-condensed table-hover display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPK</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Position</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $isi) {
                                    echo "<tr class='gradeX'>";
                                    echo "<td>$i</td>";
                                    echo "<td>$isi->CHR_NPK</td>";
                                    echo "<td>$isi->CHR_USERNAME</td>";
                                    echo "<td>$isi->CHR_ROLE</td>";
                                    if ($isi->CHR_DIVISION != NULL) {
                                        if ($isi->CHR_GROUP_DEPT != NULL) {
                                            if ($isi->CHR_DEPT != NULL) {
                                                if ($isi->CHR_SECTION != NULL) {
                                                    echo "<td>$isi->CHR_SECTION</td>";
                                                } else {
                                                    echo "<td>$isi->CHR_DEPT</td>";
                                                }
                                            } else {
                                                echo "<td>$isi->CHR_GROUP_DEPT</td>";
                                            }
                                        } else {
                                            echo "<td>$isi->CHR_DIVISION</td>";
                                        }
                                    }
                                    ?>
                                <td>
                                    <a href="<?php echo base_url('index.php/basis/user_c/select_by_id_user') . "/" . $isi->CHR_NPK ?>" class="label label-success" data-placement="left" data-toggle="tooltip" title="View"><span class="fa fa-check"></span></a>
                                    <a href="<?php echo base_url('index.php/basis/user_c/edit_user') . "/" . $isi->CHR_NPK . "/" . $isi->INT_ID_ROLE ?>" class="label label-warning" data-placement="top" data-toggle="tooltip" title="Edit"><span class="fa fa-pencil"></span></a>
                                    <a href="<?php echo base_url('index.php/basis/user_c/delete_user') . "/" . $isi->CHR_NPK ?>" class="label label-danger" data-placement="right" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure want to delete this user?');"><span class="fa fa-times"></span></a>
                                </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</aside>