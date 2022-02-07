<?php
include('top.inc.php');
$fid = " ";
$fname = " ";
$femail = " ";
$fmob = " ";
$fpass = " ";
$fdid = " ";
$fadd = " ";
$fbday = " ";
$frole = " ";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    if ($_SESSION['ROLE'] != 'Admin' && $_SESSION['USER_ID'] != $id) {
        header('location:add_faculty.php?id=' . $_SESSION['USER_ID']);
        die();
    }
    $res = mysqli_query($con, "select * from faculty where FID = '$id'");
    $row = mysqli_fetch_assoc($res);
    $fid = $row['FID'];
    $fname = $row['FName'];
    $femail = $row['Email'];
    $fmob = $row['Mobile'];
    $fpass = $row['Password'];
    $fdid = $row['DID'];
    $fadd = $row['Address'];
    $fbday = $row['Birthday'];
    $frole = $row['Role'];
}

?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Your Profile</strong></div>
                    <div class="card-body card-block">
                        <form method="post">
                            <div class="form-group">
                                <label class="form-control-label">Faculty ID</label>
                                <input type="text" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $fid;
                                                                    } ?>" name="fid" class="form-control">
                                <label class="form-control-label" style="margin-top: 10px;">Faculty name</label>
                                <input type="text" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $fname;
                                                                    } ?>" name="fname" class="form-control">
                                <label class="form-control-label" style="margin-top: 10px;">Faculty Email-ID</label>
                                <input type="email" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $femail;
                                                                    } ?>" name="femail" class="form-control">
                                <label class="form-control-label" style="margin-top: 10px;">Faculty mobile number</label>
                                <input type="text" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $fmob;
                                                                    } ?>" name="fmob" class="form-control">
                                <label class="form-control-label" style="margin-top: 10px;">Faculty password</label>
                                <input type="text" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $fpass;
                                                                    } ?>" name="fpass" class="form-control">
                                <label class="form-control-label" style="margin-top: 10px;">Faculty department name</label>
                                <input type="text" readonly value="<?php
                                                                    $DName = mysqli_fetch_assoc(mysqli_query($con, "select DName from department D, faculty F where D.DID = F.DID and FID = '" . $_SESSION['USER_ID'] . "' ;"));
                                                                    if (isset($_GET['id'])) {
                                                                        echo $DName['DName'];
                                                                    } ?>" name="fdid" class="form-control">
                                <label class="form-control-label" style="margin-top: 10px;">Faculty address</label>
                                <input type="text" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $fadd;
                                                                    } ?>" name="fadd" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty birthday</label>
                                <input type="date" readonly value="<?php
                                                                    if (isset($_GET['id'])) {
                                                                        echo $fbday;
                                                                    } ?>" name="fbday" class="form-control" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.inc.php');
?>