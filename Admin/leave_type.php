<?php
include('top.inc.php');

if ($_SESSION['ROLE'] != 'Admin') {
    header('location:add_faculty.php?id=' . $_SESSION['USER_ID']);
    die();
}

$res = mysqli_query($con, "select * from leave_type");

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "delete from leave_type where LTID = '$id'");
    header('location:leave_type.php');
    die();
}
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title" style="font-size:25px;">List of types of leaves</h4>
                        <h4 class="box-title" style="font-size:12px;"><a href="add_leave_type.php">Add new leave type</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%"> </th>
                                        <th width="10%">S.No.</th>
                                        <th width="10%">LTID</th>
                                        <th width="50%">Leave type</th>
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
                                            <td><?php echo $row['LTID'] ?></td>
                                            <td><?php echo $row['Leave_type'] ?></td>
                                            <td>
                                                <a href="add_leave_type.php?id=<?php echo $row['LTID'] ?>" style="margin-left: 20px;">EDIT</a>
                                                <a href="leave_type.php?id=<?php echo $row['LTID'] ?>&type=delete" style="margin-left:20px;">DELETE</a>
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