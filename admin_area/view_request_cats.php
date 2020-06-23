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
                <table class="table table-bordered table-striped" id="request_cat_table">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Category</th>
                      <th>Edit</th>
                      <th>Delete</th>
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
                      <td><a href="#" id="<?=$cat['request_cat_id']; ?>" class="btn btn-sm btn-warning edit_cat" /><i class="fa fa-edit"></i></a></td>
                      <td><a href="#" id="<?=$cat['request_cat_id']; ?>" class="btn btn-sm btn-danger delete_cat" /><i class="fa fa-trash"></i></a></td>
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

        $('.delete_cat').click(function(e){
          e.preventDefault();
          var request_cat_delete_id = $(this).attr('id');

          $.ajax({
            url: 'custom_docs/request_cats.php',
            type: 'POST',
            data: {
              request_cat_delete_id: request_cat_delete_id
            },
            success: function(data)
            {
              var jsonData = JSON.parse(data);

              if(jsonData == '1')
              {
                Swal.fire('Deleted Successfully', '', 'success');
                window.open('index.php?view_request_cats', '_self');
              }
              else
              {
                alert('Unsuccessful, some requests are linked to the category.\n\nEnsure there are none!');
              }
            }
          });
        });
    });

  </script>
