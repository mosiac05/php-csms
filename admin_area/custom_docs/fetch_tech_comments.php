<?php
session_start();
include '../inc/db.php';

      $comment_q = mysqli_query($con, "SELECT * FROM comments WHERE request_id = '".$_GET['request_id']."'");
        
                      while($row = mysqli_fetch_array($comment_q)){
                        $comment_id = $row['comment_id'];
                        $comment_text = $row['comment_text'];
                        $comment_date = $row['comment_date'];
                        $comment_time = $row['comment_time'];
                        $request_id = $row['request_id'];
                        $customer_id = $row['customer_id'];
                        $staff_id = $row['staff_id'];

                    ?>
                    <?php 
                          if($staff_id != NULL){
                            $staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE staff_id = '$staff_id'");

                            $row = mysqli_fetch_assoc($staff_query);
                              $staff_code = $row['staff_code'];
                              $staff_name = $row['staff_name'];
                              $staff_image = $row['staff_image'];
                              $role_id = $row['role_id'];

                              $role_query = mysqli_query($con, "SELECT role_name FROM roles WHERE role_id = '$role_id'");
                                $role = mysqli_fetch_assoc($role_query);
                         ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?=$staff_name . ' | ' . $role['role_name']; ?></span>
                        <span class="direct-chat-timestamp pull-right"><?=$comment_date . ' | ' . $comment_time; ?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="../../staff_images/<?=$staff_image; ?>" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?=$comment_text; ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                    <?php 

                          } else {
                            $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");

                            $row = mysqli_fetch_assoc($customer_query);
                              $customer_name = $row['customer_name'];
                       ?>
                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right"><?=$customer_name; ?></span>
                        <span class="direct-chat-timestamp pull-left"><?=$comment_date . ' | ' . $comment_time; ?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="../../customer_images/<?=$row['customer_image']; ?>" alt="message customer image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $comment_text; ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                  <?php } } ?>