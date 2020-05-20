<?php
include '../../inc/head.php';
include 'shared_files/info.php';
$request_status = $_GET['view_requests'];
?>

      <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="30%">ID</th>
                  <th width="40%">SUBJECT</th>
                  <!-- <th width="50%">MESSAGE</th> -->
                  <th width="30%">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  //Returns all requests based on status of the particular staff logged in
                  //else returns all NEW requests
                      if($request_status != 'NEW')
                      {
                       $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status = '$request_status' AND request_assignee = '$staff_code'"); 
                      }
                      elseif($request_status == 'DELETED')
                      {
                        $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'DELETED'");
                      }
                      else
                      {
                        $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'NEW'");
                      }
                      

                      while($row = mysqli_fetch_array($request_query)){
                          $request_id = $row['request_id'];
                          $request_code = $row['request_code'];
                          $request_subject = $row['request_subject'];
                          #$request_message = substr($row['request_message'],0,150);
                          $request_address = $row['request_address'];
                          $request_time = $row['request_time'];
                          $request_date = $row['request_date'];
                          $customer_id = $row['customer_id'];
                          
                          $request_date = date('l jS F\, Y', strtotime($request_date));
                          $request_time = date('g:iA', strtotime($request_time));


                          // $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");
                          //   $row = mysqli_fetch_assoc($customer_query);
                          //   $customer_name = $row['customer_name'];

                    ?>
                <tr>
                  <td><strong><?=$request_code; ?></strong></td>
                  <td><?=$request_subject . "<br /><span class='small'>" . $request_date . " " . $request_time . "</span>"; ?></td>
                  <!-- <td><?=$request_message; ?>...</td>      -->
                  <td>
                    <?php
                      if($request_status != 'RESOLVED')
                      {
                    ?>
                    <a href="index.php?request_id=<?=$request_id; ?>" class="btn bg-purple single-request" id="<?=$request_id; ?>">View</a>
                    <?php
                      }
                      else
                      {
                     ?>
                    <a href="index.php?resolved_id=<?=$request_id; ?>" class="btn bg-purple single-resolved" id="<?=$resolved_id; ?>">View</a>
                  <?php } ?>

                  <?php 
                    if($role_id == 1 && $request_status == 'RESOLVED')
                    {
                   ?>
                    <button type="button" id="<?=$request_id ?>" class="btn bg-red pull-right delete_submit"><i class="fa fa-trash"></i></button>
                  <?php } ?>

                  <!-- <?php 
                    if($role_id == 1 && $request_status == 'DELETED')
                    {
                   ?>
                    <button type="button" id="<?=$request_id ?>" class="btn bg-red pull-right delete_request"><i class="fa fa-trash"></i> Delete</button>
                  <?php } ?> -->
                  </td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>SUBJECT</th>
                  <!-- <th>MESSAGE</th> -->
                  <th>ACTIONS</th>
                </tr>
                </tfoot>
              </table>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.delete_submit').click(function(){
        var request_id = $(this).attr('id');
        var status = 'deleted';

        $.ajax({
          url: 'custom_docs/status_submit.php',
          type: 'POST',
          data:
          {
            request_id:request_id,
            status:status
          },
          success:function(data)
          {
              Swal.fire('Deleted Successfully!','','success' );
              window.open('index.php?view_requests=RESOLVED', '_self');
          }
        });
      });

      // $('.delete_request').click(function(){
      //   var request_id = $(this).attr('id');
      //   var status = 'delete';

      //   $.ajax({
      //     url: 'custom_docs/delete_request.php',
      //     type: 'POST',
      //     data:
      //     {
      //       request_id:request_id,
      //       status:status
      //     },
      //     success:function(data)
      //     {
      //         Swal.fire('Deleted Successfully!','','success' );
      //         window.open('index.php?view_requests=DELETED', '_self');
      //     }
      //   });
      // });
    });
  </script>
<?php 
  include 'shared_files/scripts.php';
 ?>