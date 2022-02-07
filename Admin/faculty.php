<?php
include('top.inc.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "delete from faculty where FID = '$id'");
    header('location:faculty.php');
    die();
}
$res = mysqli_query($con, "select * from faculty");
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title" style="font-size:25px;">List of faculties</h4>
                        <h4 class="box-title" style="font-size:12px;"><a href="add_faculty.php">Add new faculty</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>FID</th>
                                        <th>Faculty name</th>
                                        <th>Email-ID</th>
                                        <th>Mobile number</th>
                                        <th>Password</th>
                                        <th>DID</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td><?php echo $i ?> </td>
                                            <td><?php echo $row['FID'] ?></td>
                                            <td><?php echo $row['FName'] ?></td>
                                            <td><?php echo $row['Email'] ?></td>
                                            <td><?php echo $row['Mobile'] ?></td>
                                            <td><?php echo $row['Password'] ?></td>
                                            <td><?php echo $row['DID'] ?></td>
                                            <td><?php echo $row['Address'] ?></td>
                                            <td><?php echo $row['Role'] ?></td>
                                            <td>
                                                <a href="add_faculty.php?id=<?php echo $row['FID'] ?>" style="margin-left: 20px;">EDIT</a>
                                                <a href="faculty.php?id=<?php echo $row['FID'] ?>&type=delete" style="margin-left:20px;">DELETE</a>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.inc.php')
?>