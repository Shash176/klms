<?php
include('top.inc.php');

if ($_SESSION['ROLE'] != 'Admin') {
    header('location:add_faculty.php?id=' . $_SESSION['USER_ID']);
    die();
}

$leave_type = " ";
$LTid = " ";
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $res = mysqli_query($con, "select * from leave_type where LTID = '$id'");
    $row = mysqli_fetch_assoc($res);
    $leave_type = $row['Leave_type'];
    $LTid = $row['LTID'];
}

if (isset($_POST['leave_type'])) {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con,$_GET['id']);
        $LTid = mysqli_real_escape_string($con,$_POST['LTid']);
        $leave_type = mysqli_real_escape_string($con,$_POST['leave_type']);
        mysqli_query($con, "update leave_type set LTID = '$LTid' where LTID = '$id' ");
        mysqli_query($con, "update leave_type set leave_type = '$leave_type' where LTID = '$LTid'");
        header('location:leave_type.php');
        die();
    } else {
        $LTid = mysqli_real_escape_string($con, $_POST['LTid']);
        $leave_type = mysqli_real_escape_string($con, $_POST['leave_type']);
        mysqli_query($con, "insert into leave_type values ('$LTid','$leave_type');");
        header('location:leave_type.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add new leave type</strong></div>
                    <div class="card-body card-block">
                        <form method="post">
                            <div class="form-group">
                                <label for="LTid" class="form-control-label">Leave type ID</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $LTid;
                                                            } ?>" name="LTid" placeholder="Enter new leave type id" class="form-control" required>
                                <label for="leave_type" class="form-control-label" style="margin-top: 10px;">Leave type</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $leave_type;
                                                            } ?>" name="leave_type" placeholder="Enter new leave type" class="form-control" required>
                            </div>
                            <div style="margin: 0px 500px">
                                <button type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
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