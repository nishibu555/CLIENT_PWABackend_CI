<style type="text/css">
	body{
	margin: 0;
	padding: 0;
	font-family: sans-serif;
}
.formBox{
	margin-top: 40px;
	padding: 50px;
}
/*.formBox  h1{
	margin: 0;
	padding: 0;
	text-align: center;
	margin-bottom: 50px;
	text-transform: uppercase;
	font-size: 48px;
}*/
.inputBox{
	position: relative;
	box-sizing: border-box;
	margin-bottom: 50px;
}
.inputBox .inputText{
	position: absolute;
    font-size: 14px;
    line-height: 50px;
    transition: .5s;
    opacity: .5;
}
.inputBox .input{
	position: relative;
	width: 100%;
	height: 50px;
	background: transparent;
	border: none;
    outline: none;
    font-size: 14px;
    border-bottom: 1px solid rgba(0,0,0,.5);

}
.focus .inputText{
	transform: translateY(-30px);
	font-size: 14px;
	opacity: 1;
	color: #00bcd4;

}
textarea{
	height: 100px !important;
}
.button{
	width: 90%;
    height: 40px;
    border: none;
    outline: none;
    background: #03A9F4;
    color: #fff;
}
</style>
<div class="container-fluid" >

    <!-- Page Heading -->
<!--  -->

			<div class="formBox">
				<form action="<?php echo base_url();?>admin/save" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<h1>Add New Admin</h1>
							</div>
						</div>
						<br>
						

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText ">First Name</div>
									<input type="text" name="first_name" class="input" value="">
									<div class="err_msg"><?php echo form_error('first_name'); ?></div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText">Last Name</div>
									<input type="text" name="last_name" class="input" value="">
									<div class="err_msg"><?php echo form_error('last_name'); ?></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText ">Username</div>
									<input type="text" name="user_name" class="input" value="">
									<div class="err_msg"><?php echo form_error('user_name'); ?></div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText">Email</div>
									<input type="email" name="email" class="input" value="">
									<div class="err_msg"><?php echo form_error('email'); ?></div>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText ">Password</div>
									<input type="password" name="password" class="input" value="">
									<div class="err_msg"><?php echo form_error('password'); ?></div>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-sm-2">
								<input type="submit" name="" class="button btn btn-sm" value="Save">
							</div>
						</div>
				</form>
			</div>
	</div>


<script type="text/javascript">
	 	$(".input").focus(function() {
	 		$(this).parent().addClass("focus");
	 	})
</script>

