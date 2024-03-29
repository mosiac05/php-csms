    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Resolved Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Resolved Requests</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Resolved Requests</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body requests">
              <div class="overlay"><i class="fa fa-refresh fa-spin fa-3x"></i></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).ready(function(){
      var i = 1;

     var timer = setInterval(function(){
      if(i > 1)
      {
        clearInterval(timer);
      }
      else
      {
        $('.requests').load('custom_docs/fetch_resolved_requests.php').fadeIn('fast');
          i++;
      }

      }, 1000);
    });
  </script>