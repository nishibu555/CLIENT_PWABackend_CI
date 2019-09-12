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
				<form action="<?php echo base_url();?>recaptcha/update/<?php echo $recap_data[0]['id'];?>" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<h1>Recaptcha Settings</h1>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText ">Public Key</div>
									<input type="text" name="public_key" class="input" value="<?php echo $recap_data[0]['public_key'];?>">
									<div class="err_msg"><?php echo form_error('public_key'); ?></div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText">Secret Key</div>
									<input type="text" name="secret_key" class="input" value="<?php echo $recap_data[0]['secret_key'];?>">
									<div class="err_msg"><?php echo form_error('secret_key'); ?></div>
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

