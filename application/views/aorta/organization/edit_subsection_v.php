<aside class="right-side">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/basis/home_c/') ?>">Home</a></li>
            <li><a href="<?php echo base_url('index.php/aorta/master_data_c/manage_subsection') ?>">Manage Sub Section</a></li>
            <li><a href="#"><strong>Edit Sub Section</strong></a></li>
        </ol>
    </section>

    <section class="content">
        <?php
        if (validation_errors()) {
            echo '<div class = "alert alert-danger"><strong>WARNING !</strong>' . validation_errors() . '</div >';
        }
        echo form_open('aorta/master_data_c/update_subsection', 'class="form-horizontal"');
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="grid">
                    <div class="grid-header">
                        <i class="fa fa-sitemap"></i>
                        <span class="grid-title"><strong>EDIT</strong> SUB SECTION</span>
                        <div class="pull-right grid-tools">
                            <a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <input name="SUB_SECTION" class="form-control" type="hidden" value="<?php echo $data->KODE; ?>">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Sub Section Description</label>
                            <div class="col-sm-5">
                                <input name="SUB_SECTION_DESC" class="form-control" maxlength="40" required type="text" value="<?php echo $data->NAMA_SUBSECT; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Section Head</label>
                            <div class="col-sm-5">
                                <select name="SUB_SECTHEAD" id="secthead" class="form-control" style="width:200px">
                                    <?php
                                    foreach ($data_subsecthead as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->CHR_NPK; ?>"
                                        <?php
                                            if(trim($data->KASUBS_NPK) == trim($isi->CHR_NPK)){
                                                echo ' selected';
                                            }
                                        ?>><?php echo $isi->CHR_NPK . ' - ' . strtoupper($isi->CHR_USERNAME); ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Section</label>
                            <div class="col-sm-5">
                                <select name="SECTION" id="sect" class="form-control" style="width:200px">
                                    <?php
                                    foreach ($data_sect as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->KODE; ?>"
                                        <?php
                                            if(trim($data->KODE_SEC) == trim($isi->KODE)){
                                                echo ' selected';
                                            }
                                        ?>><?php echo $isi->KODE . ' - ' . $isi->NAMA_SECTION; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
                                    <?php echo anchor('aorta/master_data_c/manage_subsection', 'Cancel', 'class="btn btn-default"');
                                    echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</aside>

