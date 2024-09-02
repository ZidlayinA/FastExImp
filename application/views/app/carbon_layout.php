<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastExImp</title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css"
  rel="stylesheet"
/>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"
></script>


    <script type="text/javascript" src="<?php echo base_url("public/css/style.css")?>"></script>
</head>
<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php $this->load->view("app/carbon_header");?>

        <div class="main-container">
            <?php $this->load->view("app/carbon_lateral");?>
        </div>

        <div class="content">
            <div class="container-fluid">
                <?php if($success):?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                    
                    <i class="fa fa-check-circle"></i>&nbsp; <?php echo $success?>
                </div>
                <?php endif;?>
                <?php if($error_warning):?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-exclamation-triangle"></i>&nbsp; <?php echo $error_warning?>
                </div>
                <?php endif;?>
            </div>
            <?php echo $layout_content?>
        </div>

    </div>

</body>
</html>