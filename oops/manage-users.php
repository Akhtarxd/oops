<?php
 include "config.php";

 $obj= new query();
 
 if(isset($_GET['id']) && $_GET['id']!=''){
   $id = $obj->getSafeStr($_GET['id']);
   $conditionArr = array('ID'=>$id);
   $res = $obj->getData('user','*',$conditionArr);
   
   $name = $res['0']['name'];
   $email = $res['0']['email'];
   $mobile = $res['0']['mobile'];

 }

 if(isset($_POST['submit'])){
   $name = $obj->getSafeStr($_POST['name']);
   $email = $obj->getSafeStr($_POST['email']);
   $mobile = $obj->getSafeStr($_POST['mobile']);

   $conditionArr = array('name'=>$name,'email'=>$email,'mobile'=>$mobile);

   header("location: users.php");
   
 

 if(isset($_GET['id']) && $_GET['id']!=''){
   $obj->updateData('user',$conditionArr,'id',$id);
 }else{
   $obj->insertData('user',$conditionArr);
 }
}

?>


<!doctype html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Manage User - PHP Object Oriented Programming CRUD</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
	  <style>
		.container{margin-top:100px;}
	  </style>
   </head>
   <body>
      
      <div class="container">
         <div class="card">
            <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add User</strong> <a href="users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Users</a></div>
            <div class="card-body">
               <div class="col-sm-6">
                  <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>
                  <form method="post">
                     <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="<?php if(isset($name)) echo $name; ?>" class="form-control" placeholder="Enter name" required>
                     </div>
                     <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>" class="form-control" placeholder="Enter email" required>
                     </div>
                     <div class="form-group">
                        <label>Mobile <span class="text-danger">*</span></label>
                        <input type="tel" class="tel form-control" name="mobile" id="mobile" value="<?php if(isset($mobile)) echo $mobile; ?>"  placeholder="Enter mobile" required>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i><?php echo isset($_GET['id']) && $_GET['id'] != ''  ? 'Update user': 'Add user'; ?></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
   </body>
</html>