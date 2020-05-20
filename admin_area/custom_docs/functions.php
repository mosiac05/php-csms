<?php
include '../inc/db.php';

function set_customer_display() {
	global $con;
	$output = '';
	$select_query = mysqli_query($con, "SELECT customer_id, customer_name,customer_email,customer_phone_num FROM customers");
          while($row = mysqli_fetch_array($customer_query)){
                $customer_id = $row['customer_id'];
                $customer_name = $row['customer_name'];
                $customer_email = $row['customer_email'];
                $customer_phone_num = $row['customer_phone_num'];
          $output .= '
            <tr>
                  <td>'.$row['customer_name'].'</td>
                  <td>'.$row['customer_email'].'...</td>
                  <td>'.$row['customer_phone_num'].'</td>
                  <td><input type="button" name="view" value="view" id="'.$row['customer_id'].'" class="btn btn-primary view_data"></td>
                  <td><input type="button" name="edit" value="Edit" id="<?=$customer_id; ?>" class="btn btn-warning edit_data"></td>
                  <td><input type="button" name="delete" value="Delete" id="<?=$customer_id; ?>" class="btn btn-danger delete_data"></td>
                </tr>
          ';
        }
        $output .= '
          </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
        ';

        $output .= "<script>alert('Submitted Successfully')</script>";
      echo $output;
        }
 
 ?>