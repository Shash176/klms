<?php
include('top.inc.php');

$departmentnmae = " ";
$departmentid = " ";
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $res = mysqli_query($con, "select * from department where did = '$id'");
    $row = mysqli_fetch_assoc($res);
    $departmentname = $row['DName'];
    $departmentid = $row['DID'];
}

if (isset($_POST['department'])) {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $departmentid = mysqli_real_escape_string($con, $_POST['departmentid']);
        $departmentname = mysqli_real_escape_string($con, $_POST['department']);
        mysqli_query($con, "update department set DID = '$departmentid' where DID = '$id' ");
        mysqli_query($con, "update department set DName = '$departmentname' where DID = '$departmentid'");
        header('location:index.php');
        die();
    } else {
        $departmentid = mysqli_real_escape_string($con, $_POST['departmentid']);
        $department = mysqli_real_escape_string($con, $_POST['department']);
        mysqli_query($con, "insert into department values ('$departmentid','$department');");
        header('location:index.php');
        die();
    }
}
?>


<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Add new department</strong></div>
                    <div class="card-body card-block">
                        <form method="post">
                            <div class="form-group">
                                <label for="departmentid" class="form-control-label">Department ID</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $departmentid;
                                                            } ?>" name="departmentid" placeholder="Enter new department id" class="form-control" required>
                                <label for="department" class="form-control-label" style="margin-top: 10px;">Department Name</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $departmentname;
                                                            } ?>" name="department" placeholder="Enter new department name" class="form-control" required>
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