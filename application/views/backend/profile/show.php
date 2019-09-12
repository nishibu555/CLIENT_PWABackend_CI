<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="myController">

    <!-- Page Heading -->

       <h3 class="h3 mb-2 text-gray-500">Dashboard / Profile</h3>

        <!-- <a href="testimonial/add" class="btn btn-info float-right">Add New</a> -->
			<br>
<div class="col-md-6">
<img style="height: 150px; width: 150px; border-radius: 50%" src="https://www.remove.bg/images/samples/combined/s1.jpg">
  <table class="table table-borderless">

    <tbody>
      <tr>
        <th>First Name</th>
        <td>:</td>
        <td><?php echo $admin[0]['first_name']?></td>

      </tr>
      <tr>
        <th>Last Name</th>
        <td>:</td>
        <td><?php echo $admin[0]['last_name']?></td>

      </tr>
      <tr>
        <th>Username</th>
        <td>:</td>
        <td><?php echo $admin[0]['username']?></td>

      </tr>
      <tr>
        <th>Email</th>
        <td>:</td>
        <td><?php echo $admin[0]['email']?></td>

      </tr>
            <tr>
        <td><button class="btn btn-success">Edit</button>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Change Password
  </button></td>
        <td></td>

      </tr>
    </tbody>
  </table>

 </div>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        	<div style="color:red" id="msg"></div>
            <div class="form-group">
			  <label for="pwd">New Passowrd:</label>
			  <input type="password" class="form-control" id="pwd">
			</div>

  		<div class="form-group">
			  <label for="pwd">Confirmation Password:</label>
			  <input type="password" class="form-control" id="pwd2">
			</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          <button id="change_password" type="button" class="btn btn-success">Change</button>
        </div>
        
      </div>
    </div>
  </div>

<script>
	$(document).ready(function() {
		$("#change_password").on('click', function(){
			pwd = $("#pwd").val();
			pwd2 = $("#pwd2").val();
			if(pwd != pwd2){
				$("#msg").text('');
				$("#msg").text('Password Does no match');
			}else{
				$.ajax({
			        url: "<?php echo base_url();?>admin/change_password",
			        type: "post",
			        data: {pass:pwd},
			        success: function (response) {
			        	location.reload();
			           // You will get response from your PHP page (what you echo or print)
			        },
			    });
			}
		});
	});
</script>