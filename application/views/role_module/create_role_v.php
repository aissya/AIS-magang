<div id="3rd_panel" class="grid">
    <div class="grid-header">
        <i class="fa fa-calendar"></i>
        <span class="grid-title">Create <strong>ROLE</strong></span>
        <div class="pull-right grid-tools">
            <a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="grid-body">
        <?php echo form_open('budget/role_module_c/update_role', 'class="form-horizontal"'); ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Role Name</label>
            <div class="col-sm-7">
                <input name="CHR_ROLE" value=""  autofocus class="form-control" maxlength="20" required type="text">
            </div>
        </div>
        <?php
        foreach ($all_app as $app_data) {
            $x = 1;
            foreach ($all_module as $module_data) {
                if ($app_data->INT_ID_APP == $module_data->INT_ID_APP) {
                    if ($x == 1) {
                        echo '<h5><strong>' . ucfirst(strtolower($app_data->CHR_APP)) . '</strong>\' Modules </h5>';
                        $x = 0;
                    }
                    echo $module_data->CHR_MODULE;
                    echo '<table id="dataTables3" class="table table-condensed table-striped table-hover display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Function</th>
                                    
                                </tr>
                            </thead>
                            <tbody>';
                    ?>

                    <?php
                    $i = 1;


                    foreach ($all_function as $function_data) {
                        echo "<tr class='gradeX'>";
                        echo "<td>$i</td>";
                        echo "<td>$function_data->CHR_FUNCTION</td>";
                        //echo "<td>$function_data->CHR_MODULE</td>";
                        ?>

                        </tr>
                        <?php
                        $i++;
                    }
                    echo '</tbody>
                    </table>';
                }
            }
        }
        ?>


        <?php echo form_close(); ?>
    </div>
</div>
