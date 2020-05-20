
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          
      </div>
      <!-- End of box -->
    </section>
  </div>













  
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View &amp; Add Banners
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">View &amp; Add Banners</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">



      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View &amp; Add Banners</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary" title="Add New Banner" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"> Add New Banner</i>
            </button>
          </div>
          <div class="modal modal-default fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a New Banner</h4>
              </div>
              <div class="modal-body">
                <form class="form" action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Blog Title:</label>                
                    <input type="text" name="title" id="title" placeholder="Enter Blog Title..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="">Blog Post:</label>                
                    <textarea name="text" id="editor1" placeholder="Enter Blog Post..." rows="10" class="form-control" required=""></textarea>
                  </div>

                  <div class="form-group">
                    <label for="blog_image">Select Blog Image:</label>                
                    <input type="file" name="blog_image" id="blog_image" class="btn btn-warning">
                  </div>

                  <div class="form-group">
                    <label for="tag">Blog Tags:</label>                
                    <input type="text" name="tag" id="tag" placeholder="Enter Blog Tags e.g learn, people, sports..." class="form-control" required="">
                  </div>

                   <div class="form-group">
                    <label for="author">Blog Author:</label>                
                    <input type="text" name="author" id="author" placeholder="Enter Blog Author..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="author_image">Select Author Image:</label>                
                    <input type="file" name="author_image" id="author_image" class="btn btn-warning">
                  </div>

                  <div class="form-group">
                    <label for="cat">Blog Category:</label>                
                    <select id="cat" name="cat" class="form-control" required="">
                      <option disabled="" selected="">Select Blog Category:</option>
                      <?php 
                        $blog_cat_q = mysqli_query($con, "select * from blog_cats");
                         while($row = mysqli_fetch_array($blog_cat_q)){
                          $blog_cat_id = $row['blog_cat_id'];
                          $blog_category = $row['blog_category'];
                      ?>
                      <option value="<?=$blog_cat_id; ?>"><?=$blog_category; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="blog_submit" value="Add Blog Post" class="btn btn-primary col-md-offset-4">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        </div>
          <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0; 
                      $banner_query = mysqli_query($con, "select * from banners");

                      while($row = mysqli_fetch_array($banner_query)){
                          $banner_id = $row['banner_id'];
                          $banner_text = $row['banner_text'];
                          $banner_image = $row['banner_image'];
                          $i++;

                    ?>
                    <tr>
                      <td><?=$i; ?></td>
                      <td><?=$banner_text; ?>...</td>
                      <td><img src="../images/banner_images/<?=$banner_image; ?>" width="150"></td>
                      <td><a href="index.php?edit_banner=<?=$banner_id; ?>"><i class="fa fa-pencil"></i></a></td>
                      <td><a href="delete_banner.php?delete_banner=<?=$banner_id; ?>"><i class="fa fa-trash"></i></a></td>
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
