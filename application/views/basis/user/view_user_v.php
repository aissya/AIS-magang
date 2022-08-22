<aside class="right-side">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/home_c/') ?>">Home</a></li>
            <li><a href="<?php echo base_url('index.php/basis/user_c/') ?>">Manage Employee</a></li>            
            <li><a href="#"><strong>View Employee</strong></a></li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="grid">
                    <div class="grid-header">
                        <i class="fa fa-user"></i>
                        <span class="grid-title"><strong>EMPLOYEE</strong> <?php echo $data->CHR_USERNAME; ?></span>
                        <div class="pull-right grid-tools">
                            <a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <table class="table table-condensed table-striped display" cellspacing="0" width="100%">
                            <tr><td>NPK</td><td><?php echo $data->CHR_NPK; ?></td></tr>
                            <tr><td>Username</td><td><?php echo $data->CHR_USERNAME; ?></td></tr>
                            <tr><td>Level</td><td><?php echo $data->CHR_ROLE; ?></td></tr>
                            <tr><td>Position</td>
                                <?php
                                    if ($data->CHR_DIVISION != NULL) {
                                        if ($data->CHR_GROUP_DEPT != NULL) {
                                            if ($data->CHR_DEPT != NULL) {
                                                if ($data->CHR_SECTION != NULL) {
                                                    echo "<td>$data->CHR_SECTION</td>";
                                                } else {
                                                    echo "<td>$data->CHR_DEPT</td>";
                                                }
                                            } else {
                                                echo "<td>$data->CHR_GROUP_DEPT</td>";
                                            }
                                        } else {
                                            echo "<td>$data->CHR_DIVISION</td>";
                                        }
                                    }
                                
                                ?>
                            </tr>
                        </table>

                        <?php echo anchor('basis/user_c', 'Back', 'class="btn btn-default"'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>