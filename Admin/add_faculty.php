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

if (isset($_POST['submit'])) {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $fid = mysqli_real_escape_string($con, $_POST['fid']);
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $femail = mysqli_real_escape_string($con, $_POST['femail']);
        $fmob = mysqli_real_escape_string($con, $_POST['fmob']);
        $fpass = mysqli_real_escape_string($con, $_POST['fpass']);
        $fdid = mysqli_real_escape_string($con, $_POST['fdid']);
        $fadd = mysqli_real_escape_string($con, $_POST['fadd']);
        $fbday = mysqli_real_escape_string($con, $_POST['fbday']);
        $frole = mysqli_real_escape_string($con, $_POST['frole']);
        mysqli_query($con, "update faculty set FID = '$fid' where FID = '$id';");
        mysqli_query($con, "update faculty set Fname = '$fname' where FID = '$fid';");
        mysqli_query($con, "update faculty set Email = '$femail' where FID = '$fid';");
        mysqli_query($con, "update faculty set Mobile = '$fmob' where FID = '$fid';");
        mysqli_query($con, "update faculty set Password = '$fpass' where FID = '$fid';");
        mysqli_query($con, "update faculty set DID = '$fdid' where FID = '$fid';");
        mysqli_query($con, "update faculty set Address = '$fadd' where FID = '$fid';");
        mysqli_query($con, "update faculty set Birthday = '$fbday' where FID = '$fid';");
        mysqli_query($con, "update faculty set Role = '$frole' where FID = '$fid';");
        $_SESSION['ROLE'] = $frole;
        header('location:faculty.php');
        die();
    } else {
        $fid = mysqli_real_escape_string($con, $_POST['fid']);
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $femail = mysqli_real_escape_string($con, $_POST['femail']);
        $fmob = mysqli_real_escape_string($con, $_POST['fmob']);
        $fpass = mysqli_real_escape_string($con, $_POST['fpass']);
        $fdid = mysqli_real_escape_string($con, $_POST['fdid']);
        $fadd = mysqli_real_escape_string($con, $_POST['fadd']);
        $fbday = mysqli_real_escape_string($con, $_POST['fbday']);
        $frole = mysqli_real_escape_string($con, $_POST['frole']);
        mysqli_query($con, "insert into faculty values ('$fid','$fname','$femail','$fmob','$fpass','$fdid','$fadd','$fbday','$frole');");
        header('location:faculty.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                    if (isset($_GET['id'])) {
                    ?>
                        <div class="card-header" style="font-size:25px;"><strong>Edit faculty</strong></div>
                    <?php
                    } else {
                    ?>
                        <div class="card-header" style="font-size:25px;"><strong>Add new faculty</strong></div>
                    <?php
                    }
                    ?>
                    <div class="card-body card-block">
                        <form method="post">
                            <div class="form-group">
                                <label class="form-control-label">Faculty ID</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $fid;
                                                            } ?>" name="fid" placeholder="Enter new faculty id" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty name</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $fname;
                                                            } ?>" name="fname" placeholder="Enter new faculty name" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty Email-ID</label>
                                <input type="email" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $femail;
                                                            } ?>" name="femail" placeholder="Enter new faculty email" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty mobile number</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $fmob;
                                                            } ?>" name="fmob" placeholder="Enter new faculty mobile number" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty password</label>
                                <input type="password" value="<?php
                                                                if (isset($_GET['id'])) {
                                                                    echo $fpass;
                                                                } ?>" name="fpass" placeholder="Enter new faculty password" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty department name</label>
                                <select class="form-control" name="fdid" required>
                                    <option value=" " style="color: red;">Select Department</option>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $res = mysqli_query($con, "select * from department order by DID;");
                                        $temp = mysqli_query($con, "select * from faculty;");
                                        $fac = mysqli_fetch_assoc($temp);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            if ($row['DID'] == $fac['DID']) {
                                                echo "<option selected='selected' value =" . $row['DID'] . ">" . $row['DName'] . "</option>";
                                            } else {
                                                echo "<option value =" . $row['DID'] . ">" . $row['DName'] . "</option>";
                                            }
                                        }
                                    } else {
                                        $res = mysqli_query($con, "select * from department order by DID;");
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<option value =" . $row['DID'] . ">" . $row['DName'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty address</label>
                                <input type="text" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $fadd;
                                                            } ?>" name="fadd" placeholder="Enter new faculty address" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Faculty birthday</label>
                                <input type="date" value="<?php
                                                            if (isset($_GET['id'])) {
                                                                echo $fbday;
                                                            } ?>" name="fbday" placeholder="Enter new faculty birthday" class="form-control" required>
                                <label class="form-control-label" style="margin-top: 10px;">Role to be given</label>
                                <?php
                                if (isset($_GET['id'])) {
                                ?><select name="frole" class="form-control">
                                        <?php if ($frole == 'Admin') { ?>
                                            <option value="Admin" selected>Admin</option>
                                            <option value="Faculty">Faculty</option>
                                            <option value="HOD">HOD</option>
                                            <option value="Principal">Principal</option>
                                        <?php } ?>
                                        <?php if ($frole == 'Faculty') { ?>
                                            <option value="Admin">Admin</option>
                                            <option value="Faculty" selected>Faculty</option>
                                            <option value="HOD">HOD</option>
                                            <option value="Principal">Principal</option>
                                        <?php } ?>
                                        <?php if ($frole == 'HOD') { ?>
                                            <option value="Admin">Admin</option>
                                            <option value="Faculty">Faculty</option>
                                            <option value="HOD" selected>HOD</option>
                                            <option value="Principal">Principal</option>
                                        <?php } ?>
                                        <?php if ($frole == 'Principal') { ?>
                                            <option value="Admin">Admin</option>
                                            <option value="Faculty">Faculty</option>
                                            <option value="HOD">HOD</option>
                                            <option value="Principal" selected>Principal</option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select name="frole" class="form-control">
                                        <option value=" " style="color: red;"> Select the role to be given</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="HOD">HOD</option>
                                        <option value="Principal">Principal</option>
                                    </select>
                                <?php } ?>
                            </div>
                            <div style="margin: 0px 500px">
                                <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount"> <a href="add_faculty.php?id="<?php echo $fid ?>></a> Submit</span>
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