<?php
include '../../inc/head.php';
?>

      <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th width="20">ID</th>
                  <th width="60">SUBJECT</th>
                  <th width="20">VIEW</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      $resolved_query = mysqli_query($con, "SELECT * FROM resolved_requests ORDER BY 1 DESC");

                      while($row = mysqli_fetch_array($resolved_query)){
                          $resolved_id = $row['resolved_id'];
                          $resolved_subject = $row['resolved_subject'];
                          #$resolved_message = substr($row['resolved_message'],0,150);
                          $resolved_address = $row['resolved_address'];
                          $resolved_time = $row['resolved_time'];
                          $resolved_date = $row['resolved_date'];
                          $request_code = $row['request_code'];
                          $customer_id = $row['customer_id'];
                          $request_assignee = $row['request_assignee'];

                          $resolved_date = date('l jS F\, Y', strtotime($resolved_date));
                          $resolved_time = date('g:iA', strtotime($resolved_time));


                          $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");
                            $row = mysqli_fetch_assoc($customer_query);
                            $customer_name = $row['customer_name'];

                    ?>
                <tr>
                  <td><strong><?=$request_code; ?></strong></td>
                  <td><?=$resolved_subject . "<br /><span class='small'>" . $resolved_date . " " . $resolved_time . "</span>"; ?></td>
                  <td><a href="index.php?resolved_id=<?=$resolved_id; ?>" class="btn bg-purple resolved_btn" id="<?php echo $resolved_id; ?>">View</a></td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>SUBJECT</th>
                  <th>VIEW</th>
                </tr>
                </tfoot>
              </table>
<?php 
  include 'shared_files/scripts.php';
 ?>