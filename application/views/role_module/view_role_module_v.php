<div id="3rd_panel" class="grid">
    <div class="grid-header">
        <i class="fa fa-calendar"></i>
        <span class="grid-title"><strong>ROLE</strong> Detail</span>
        <div class="pull-right grid-tools">
            <a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="grid-body">

        <h4><strong><?php echo $role->CHR_ROLE ?></strong>'s Applications </h4>
        <?php
        $co = count($rm);

        if ($rm != 0) {
            echo '<table class="table table-striped table-condensed table-hover display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Applications</th>
                    <th>Action</th>
                    

                </tr>
            </thead>
            <tbody>';
            ?>

            <?php
            $i = 1;


            foreach ($app as $isi) {
                echo "<tr class='gradeX'>";
                echo "<td>$i</td>";
                echo "<td>" . ucfirst(strtolower($isi->CHR_APP)) . "</td>";
                ?>
                <td>
                    <a href="#" class="label label-success" data-placement="left" data-toggle="tooltip" title="View"><span class="fa fa-check"></span></a>
                </td>
                </tr>
                <?php
                $i++;
            }
            echo '</tbody>
                    </table>';
        } else {
            echo 'No data recorded.';
        }
        ?>
        <p>
        <h4><strong><?php echo $role->CHR_ROLE ?></strong>'s Modules </h4>
        <?php
        $co = count($rm);

        if ($rm != 0) {
            echo '<table id="dataTables1" class="table table-condensed table-striped table-hover display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Function</th>
                    <th>Module</th>
                    

                </tr>
            </thead>
            <tbody>';
            ?>

            <?php
            $i = 1;


            foreach ($rm as $isi) {
                echo "<tr class='gradeX'>";
                echo "<td>$i</td>";
                echo "<td>$isi->CHR_FUNCTION</td>";
                echo "<td>$isi->CHR_MODULE</td>";
                ?>

                </tr>
                <?php
                $i++;
            }
            echo '</tbody>
                    </table>';
        } else {
            echo 'No data recorded.';
        }
        ?>
    </div>
</div>
