<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Request Categories
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Request Categories</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Request Categories</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <form class="form" id="cat_form" action="" method="post">
                  <div class="form-group">
                    <label for="cat">Request Category:</label>                
                    <input type="text" name="cat" id="cat" placeholder="Enter new category here..." class="form-control" required="">
                  </div>
                  <div class="form-group">                
                    <input type="submit" name="ct" id="cat_submit" value="Add New Category" class="btn bg-purple">
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped" id="area_table">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Category</th>
                      <th>Edit</th>
                      <!-- <th>Delete</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $cat_query = mysqli_query($con, "SELECT request_cat_id,request_category FROM request_cats");
                      while($cat = mysqli_fetch_array($cat_query)){
                        $i++;
                     ?>
                    <tr>
                      <td><?=$i; ?></td>
                      <td><?=$cat['request_category']; ?></td>
                      <td><input type="submit" name="edit_cat" value="Edit" id="<?=$cat['request_cat_id']; ?>" class="btn btn-warning edit_cat" /></td>
                      <!-- <td><input type="submit" name="delete_area" value="Delete" id="<?=$area['area_id']; ?>" class="btn btn-danger delete_area" /></td> -->
                    </tr>
                  <?php } ?>
                  </tbody>
                  
                </table>
              </div>            
          </div>
      </div>
      <!-- End of box -->
    </section>
  </div>


<div id="edit_Modal" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Request Category</h4>
        </div>
        <div class="modal-body" id="cat_edit">
          <form class="form" id="cat_edit_form" action="" method="post">
            <div class="form-group">
              <label for="request_cat_edit">Request Category:</label>                
              <input type="text" name="request_cat_edit" id="request_cat_edit" placeholder="Enter category here..." class="form-control" required="">
            </div>
            <input type="hidden" name="cat_id" id="cat_id" />
            <div class="form-group">                
              <input type="submit" name="cet" id="cat_edit" value="Click to Submit" class="btn bg-purple col-md-offset-4">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



<div id="delete_cat" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Request Category?</h4>
        </div>
        <div class="modal-body" id="role_delete">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



  <script>
    $(document).ready(function(){

        $(document).on('click', '.edit_cat', function(){
          var cat_id = $(this).attr("id");

          $.ajax({
            url:'custom_docs/fetch_cats.php',
            method:'post',
            data:{cat_id:cat_id},
            dataType:"json",
            success:function(data){
              $('#request_cat_edit').val(data.request_category);
              $('#cat_id').val(data.request_cat_id);
              $('#cat_edit').val('Edit Category');
              $('#edit_Modal').modal('show');
            }
          });
        });

        function get_page(page_name){
          $.ajax({
            url: 'custom_docs/page_load.php',
            method: 'get',
            data: {page_name:page_name},
            success:function(data)
            {
              $('.content-wrapper').html(data);
              history.pushState(null, null, '?'+page_name);
            }
          });
        }

        $('#cat_edit_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/request_cats.php',
            type: 'POST',
            data: $('#cat_edit_form').serialize(),
            success: function()
            {
              Swal.fire('Edited Successfully!','','success');
              $('#cat_edit_form')[0].reset();
              $('.modal-backdrop').remove();
              window.open('index.php?view_request_cats', '_self')
            }
          });
        });


        $('#cat_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/request_cats.php',
            type: 'POST',
            data: $('#cat_form').serialize(),
            success: function()
            {
              Swal.fire('Added Successfully!','','success');
              $('#cat_form')[0].reset();
              $('.modal-backdrop').remove();
              window.open('index.php?view_request_cats', '_self')
            }
          });
        });
    });

  </script>
