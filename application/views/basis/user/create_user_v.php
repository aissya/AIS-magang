<script language="JavaScript">
    function angka(objek) {
        a = objek.value;
        b = a.replace(/[^\d]/g, "");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
                c = b.substr(i - 1, 1) + "" + c;
            } else {
                c = b.substr(i - 1, 1) + c;
            }
        }
        objek.value = Number(c);
    }

    function Number(s) {

        while (s.substr(0, 1) == '' && s.length > 1) {
            s = s.substr(1, 9999);
        }
        return s;
    }

    $(document).ready(function() {
        $("select").change(function() {
            $("select option:selected").each(function() {
                if ($(this).attr("value") == 1) {
                    $("#division").show();
                    $("#gm").show();
                    $("#dept").show();
                    $("#section").show();
                    $("#subsection").hide();
                }
                if ($(this).attr("value") == 2) {
                    $("#division").show();
                    $("#gm").show();
                    $("#dept").show();
                    $("#section").show();
                    $("#subsection").hide();
                    
                }
                if ($(this).attr("value") == 3) {
                    $("#section").hide();
                    $("#dept").hide();
                    $("#gm").hide();
                    $("#division").show();
                    $("#subsection").hide();
                }
                if ($(this).attr("value") == 4) {
                    $("#section").hide();
                    $("#dept").hide();
                    $("#gm").show();
                    $("#division").show();
                    $("#subsection").hide();
                }
                if ($(this).attr("value") == 5) {
                    $("#section").hide();
                    $("#dept").show();
                    $("#gm").show();
                    $("#division").show();
                    $("#subsection").hide();
                }
                if ($(this).attr("value") == 6) {
                    $("#section").show();
                    $("#dept").show();
                    $("#gm").show();
                    $("#division").show();
                    $("#subsection").hide();
                }
                if ($(this).attr("value") == 7) {
                    $("#section").show();
                    $("#dept").show();
                    $("#gm").show();
                    $("#division").show();
                    $("#subsection").show();
                }
            });
        }).change();
    });

</script>

<aside class="right-side">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('index.php/basis/home_c/') ?>">Home</a></li>
            <li><a href="<?php echo base_url('index.php/basis/user_c/') ?>">Manage Employee</a></li>
            <li><a href="#"><strong>Create Employee</strong></a></li>
        </ol>
    </section>

    <section class="content">
        <?php
        if (validation_errors()) {
            echo '<div class = "alert alert-danger"><strong>WARNING !</strong>' . validation_errors() . '</div >';
        }
        echo form_open('basis/user_c/save_user', 'class="form-horizontal"');
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="grid">
                    <div class="grid-header">
                        <i class="fa fa-certificate"></i>
                        <span class="grid-title"><strong>CREATE</strong> EMPLOYEE</span>
                        <div class="pull-right grid-tools">
                            <a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="grid-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Company</label>
                            <div class="col-sm-5">
                                <select name="INT_ID_COMPANY" class="form-control" style="width:400px">
                                    <?php
                                    foreach ($data_company as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_COMPANY; ?>"><?php echo $isi->CHR_COMPANY . ' - ' . $isi->CHR_COMPANY_DESC; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">NPK</label>
                            <div class="col-sm-5">
                                <input name="CHR_NPK" class="form-control" maxlength="6" autocomplete="off" onkeyup="angka(this);" required type="text" style="width: 80px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Level</label>
                            <div class="col-sm-5">
                                <select id="level" name="INT_ID_ROLE" class="form-control" onchange="gantirole()" style="width:400px">
                                    <?php
                                    foreach ($data_role as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_ROLE; ?>"><?php echo $isi->CHR_ROLE; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>

                        <div id="division" class="form-group" style="display:none;">
                            <label class="col-sm-3 control-label">Division</label>
                            <div class="col-sm-5">
                                <select name="INT_ID_DIVISION" class="form-control" style="width:400px" >
                                    <option selected="true" value=0>--Choose Division--</option>
                                    <?php
                                    foreach ($data_div as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_DIVISION; ?>"><?php echo $isi->CHR_DIVISION . ' - ' . $isi->CHR_DIVISION_DESC; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>

                        <div id="gm" class="form-group" style="display:none;">
                            <label class="col-sm-3 control-label">Group Department</label>
                            <div class="col-sm-5">
                                <select name="INT_ID_GROUP_DEPT"  class="form-control" style="width:400px" >
                                    <option selected="true" value=0>--Choose Group Department--</option>
                                    <?php
                                    foreach ($data_groupdept as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_GROUP_DEPT; ?>"><?php echo $isi->CHR_GROUP_DEPT . ' - ' . $isi->CHR_GROUP_DEPT_DESC; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>


                        <div id="dept" class="form-group" style="display:none;">
                            <label class="col-sm-3 control-label">Department</label>
                            <div class="col-sm-5">
                                <select name="INT_ID_DEPT"  class="form-control" style="width:400px" >
                                    <option selected="true" value=0>--Choose Department--</option>
                                    <?php
                                    foreach ($data_dept as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_DEPT; ?>"><?php echo $isi->CHR_DEPT . ' - ' . $isi->CHR_DEPT_DESC; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>

                        <div id="section" class="form-group" style="display:none;">
                            <label class="col-sm-3 control-label">Section</label>
                            <div class="col-sm-5">
                                <select name="INT_ID_SECTION"  class="form-control" style="width:400px" >
                                    <option selected="true" value=0>--Choose Section--</option>
                                    <?php
                                    foreach ($data_section as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_SECTION; ?>"><?php echo $isi->CHR_SECTION . ' - ' . $isi->CHR_SECTION_DESC; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>

                        <div id="subsection" class="form-group" style="display:none;">
                            <label class="col-sm-3 control-label">Sub Section</label>
                            <div class="col-sm-5">
                                <select name="INT_ID_SUB_SECTION"  class="form-control" style="width:400px">
                                    <option selected="true" value=0>--Choose Subsection--</option>
                                    <?php
                                    foreach ($data_subsection as $isi) {
                                        ?>
                                        <option value="<?php echo $isi->INT_ID_SUB_SECTION; ?>"><?php echo $isi->CHR_SUB_SECTION . ' - ' . $isi->CHR_SUB_SECTION_DESC; ?></option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">User name</label>
                            <div class="col-sm-5">
                                <input name="CHR_USERNAME" class="form-control" maxlength="20" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-5">
                                <input name="CHR_PASS" class="form-control" required type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-5">
                                <input name="CHR_PASS_CONFIRM" class="form-control" required type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary" data-placement="left" data-toggle="tooltip" title="Save this data"><i class="fa fa-check"></i> Save</button>
                                    <?php
                                    echo anchor('basis/user_c', 'Cancel', 'class="btn btn-default" data-placement="right" data-toggle="tooltip" title="Back to manage"');
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