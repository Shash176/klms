<?php
include('top.inc.php');
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "delete from department where DID = '$id'");
    header('location:index.php');
    die();
}
$res = mysqli_query($con, "select * from department");

if($_SESSION['ROLE'] == 'Admin' || $_SESSION['ROLE'] == 'admin') {
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title" style="font-size:25px;">List of departments</h4>
                        <h4 class="box-title" style="font-size:12px;"><a href="add_department.php">Add new department</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%"> </th>
                                        <th width="10%">S.No.</th>
                                        <th width="10%">DID</th>
                                        <th width="50%">Department Name</th>
                                        <th width="20%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $i ?> </td>
                                            <td><?php echo $row['DID'] ?></td>
                                            <td><?php echo $row['DName'] ?></td>
                                            <td>
                                                <a href="add_department.php?id=<?php echo $row['DID'] ?>" style="margin-left: 20px;">EDIT</a>
                                                <a href="index.php?id=<?php echo $row['DID'] ?>&type=delete" style="margin-left:20px;">DELETE</a>
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
 }
 else {
     header('location:add_faculty.php?id='.$_SESSION['USER_ID']);
 } ?>
<?php
include('footer.inc.php')
?>