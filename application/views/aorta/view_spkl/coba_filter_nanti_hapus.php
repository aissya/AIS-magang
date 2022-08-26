<!DOCTYPE html>
<html>

<body>

    <div class="row">
        <div class="col-md-12">
            <div class="grid">
                <div class="grid-header">
                    <i class="fa fa-clock-o"></i>
                    <span class="grid-title"><strong>VIEW SPKL</strong></span>
                    <div class="pull-right grid-tools">
                        <div class="grid-body">
                            <div class="pull">
                                <table width="100%" id='filter'>
                                    <tr>
                                        <td width="10%" style='text-align:left;'><strong>Tanggal / Dept </strong></td>

                                        <td width="10%" style='text-align:left;' colspan="4">
                                            <select id="deptIDno" class="ddl">

                                                <?php foreach ($option_filter_dept as $key) : ?>
                                                    <option value=""><?= $key->KODE ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <form>
                                            Select your favorite fruit:
                                            <select id="deptID">
                                                <option value="apple">Apple</option>
                                                <option value="orange">Orange</option>
                                                <option value="pineapple">Pineapple</option>
                                                <option value="banana">Banana</option>
                                            </select>
                                        </form>


                                        <p>Click the button to return the value of the selected fruit.</p>

                                        <button type="button" onclick="myFunction()">Try it</button>

                                        <p id="demo"></p>


                                        <script>
                                            function myFunction() {
                                                var x = document.getElementById("deptID").value;
                                                document.getElementById("demo").innerHTML = x;
                                            }

                                            function yourFunction() {
                                                var x = document.getElementById("deptIDno").value;
                                                document.getElementById("tidakdemo").innerHTML = x;
                                            }
                                        </script>

                                        <td width="50%">

                                        </td>
                                        <td width="10%">
                                        </td>

                                </table>
                                <button type="button" onclick="yourFunction()">Try it</button>
                                <p id="tidakdemo"></p>

                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>


</body>

</html>