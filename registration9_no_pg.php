<?php

// session_start();

include 'csrf_token.php';

$assoc_name = @$_GET['assoc_name'];
$assoc_name = trim($assoc_name);
$tin_no = @$_GET['tin_no'];

if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
    session_destroy();
    mysqli_close($link);
    echo "<script language='javascript'>alert('Session Expired.');</script>";
    echo "<script language='javascript'>window.location = 'https://sci25.supercomputingindia.org';</script>";
    exit;
}
require ("form_includes/form_constants_both.php");
require "dbcon_open.php";
$reg_id = $_SESSION['vercode_reg'];

?>
<?php require 'form_includes/reg_form_header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered" id="registration_form_4">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase"> Attendee(s) Registration Form
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <!-- <li class="done">
                  <a class="step dips-default-cursor">
                    <span class="number"> 1 </span>
                    <span class="desc">
                      <i class="fa fa-check"></i> Registration Category </span>
                  </a>
                </li> -->
                            <li class="done">
                                <a data-toggle="tab" class="step dips-default-cursor">
                                    <span class="number"> 1 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Attendee(s) Information </span>
                                </a>
                            </li>
                            <li class="done">
                                <a data-toggle="tab" class="step dips-default-cursor">
                                    <span class="number"> 2 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Preview </span>
                                </a>
                            </li>

                            <li class="active">
                                <a data-toggle="tab" class="step dips-default-cursor">
                                    <span class="number"> 3 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Confirmation Pending </span>
                                </a>
                            </li>

                            <!-- <li>
                                    <a data-toggle="tab" class="step dips-default-cursor">
                                        <span class="number"> 4 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Receipt </span>
                                    </a>
                                </li> -->

                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <h3 class="block">Confirm Registration Detail</h3>

                                <div class="portlet-body">

                                    <div class="table-scrollable">

                                        <table class="table table-striped table-bordered table-hover">

                                            <tbody>



                                                <tr>

                                                    <td>

                                                         <strong>"Thank you for registering" We will contact you through your registered email for further processing.</strong></td>



                                                </tr>
     <?php /*                                      
     <tr>
                                                    <td>
                                                       
                                                </tr>
*/ ?>
<tr>
<td>
</tr> 

   <?php /*                                             <tr>

                                                    <td> <strong>For More Details, Please connect

                                                            with:</strong> </td>



                                                </tr>

                                                <tr>

                                                    <td>Name: Sathyakanth Manukar <br />

                                                        Email:<a

                                                            href="mailto:sci-expo@cdac.in">sci-expo@cdac.in</a><br />

                                                        Mobile: +91 90353 47772<br />

                                                        <!-- Phone:+91.80.4113 1912/3<br /> -->

                                                    </td>



                                                </tr>

*/ ?>

                                                <tr>


                                                    <td>

                                                        <h4><strong>Note:</strong> Please check your

                                                            spam / junk mail box / mail folder. You will

                                                            receive the email from "

                                                            sci@cdac.in ". </h4>

                                                    </td>



                                                </tr>





                                            </tbody>

                                        </table>

                                    </div>



                                </div>





                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<?php require 'form_includes/reg_form_footer.php'; ?>
<script>
    function go_back() {
        var del_id = '<?php echo $del; ?>';
        var cit = '<?php echo $cit; ?>';
        var url = 'info.php?del=' + del_id + '&cit=' + cit + '&ret=retds4fu324rn_ed24d3it';
        window.location.href = url;
    }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
