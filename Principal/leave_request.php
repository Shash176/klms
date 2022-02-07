<?php
include('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] == 'update' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $status = mysqli_real_escape_string($con, $_GET['status']);
   if ($status == '2') {
        mysqli_query($con, "update leave_applied set PLS = '2' where LID ='" . $id . "'");
    } else  if ($status == '3') {
        mysqli_query($con, "update leave_applied set PLS = '3' where LID ='" . $id . "'");
    }
    header('location:leave_request.php');
    die();
}

$res = mysqli_query($con, "select * from leave_applied where HODLS = '2'");

?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title" style="font-size:25px;">List of leave adjustment requested</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Leave ID</th>
                                        <th>Leave applied faculty ID</th>
                                        <th>Leave applied faculty name</th>
                                        <th>Type of leave</th>
                                        <th>Leave from</th>
                                        <th>Leave to</th>
                                        <th>Adjusted faculty ID</th>
                                        <th>Adjusted faculty name</th>
                                        <th>Leave description</th>
                                        <th>Leave status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $row['LID'] ?></td>
                                            <td style="text-align: center;"><?php echo $row['FID'] ?></td>
                                            <?php
                                            $ffn = mysqli_query($con, "select FName from faculty where FID = '" . $row['FID'] . "'");
                                            $fname = mysqli_fetch_assoc($ffn);
                                            ?>
                                            <td style="text-align: center;"><?php echo $fname['FName'] ?></td>
                                            <td><?php echo $row['Leave_type'] ?></td>
                                            <td><?php echo $row['Leave_from'] ?></td>
                                            <td><?php echo $row['Leave_to'] ?></td>
                                            <td><?php echo $row['FAID'] ?></td>
                                            <td><?php echo $row['FAName'] ?></td>
                                            <td><?php echo $row['Leave_desc'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['PLS'] == '1')
                                                    echo "Applied";
                                                if ($row['PLS'] == '2')
                                                    echo "Approved";
                                                if ($row['PLS'] == '3')
                                                    echo "Rejected";
                                                ?><br>
                                                <select name="uls" onchange="update_status('<?php echo $row['LID'] ?>', this.options[this.selectedIndex].value)">
                                                    <option value="1">Update status</option>
                                                    <option value="2">Approve</a></option>
                                                    <option value="3">Reject</option>
                                                </select>
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
<script>
    function update_status(lid, value) {
        window.location.href = "http://localhost/lms/Principal/leave_request.php?id=" + lid + "&type=update&status=" + value;
    }
</script>
<?php
include('footer.inc.php')
?>