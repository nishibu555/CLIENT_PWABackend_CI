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
       <h3 class="h3 mb-2 text-gray-500">Dashboard / Clients</h3>

       <a href="<?php echo base_url();?>clients" class="btn btn-info float-right"><i class="fas fa-list"></i> Client List</a>
<br>
			<div class="formBox">
				<form action="<?php echo base_url();?>client/update/<?php echo $client[0]['id'] ?>" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<h1>Edit Client</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus" id="fullname">
									<div class="inputText">Full Name</div>
									<input type="text" name="full_name"  class="input" value="<?php echo $client[0]['name'] ?>">
									<div class="err_msg"><?php echo form_error('full_name'); ?></div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox focus" id="phone">
									<div class="inputText">Phone</div>
									<input type="tel" name="phone" class="input" value="<?php echo $client[0]['phone']?>">
									<div class="err_msg"><?php echo form_error('phone'); ?></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus" id="website">
									<div class="inputText">Website</div>
									<input type="text" name="website" class="input" value="<?php echo $client[0]['website']?>">
									<div class="err_msg"><?php echo form_error('website'); ?></div>
								</div>
								<div class="inputBox focus" id="description">
									<div class="inputText">Description</div>
									<textarea class="input" name="description"><?php echo $client[0]['phone']?></textarea>
									<div class="err_msg"><?php echo form_error('description'); ?></div>
								</div>
							</div>

							<div class="col-sm-6">
							<div class="inputBox focus">
									<div id="addFileName"></div>
									<!-- <div class="inputText">Main Image</div> -->
				            <div class="m-dropzone dropzone m-dropzone--primary" id="ss_dropzone">
				                <div class="m-dropzone__msg dz-message needsclick">

				                    <div style="width: 70%; margin: 20px auto;">
				                      <img style="height: 100px; width: 100px " src="<?php echo base_url();?>/assets/uploads/client_logo/<?php echo $client[0]['logo']?>">
				                 </div>
				                 <h4>Client Logo</h4>
				                 <!-- <h3 class="m-dropzone__msg-title">Choose an image from your computer
				                 </h3> -->
				                 <!-- <span class="m-dropzone__msg-desc">JPG, PNG, GIF or BNP<br/>
				                 Recommended 1600x930 pixels for images</span> -->
				                 <div class="dz-error-message"><span data-dz-errormessage></span></div>
				             </div>
				         </div>
								<div class="err_msg"><?php echo form_error('userfile'); ?></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								
							</div>
						</div>

						<div class="row">
							<div class="col-sm-2">
								<input type="submit" name="" class="button btn btn-sm" value="Update">
							</div>
						</div>
				</form>
			</div>
	</div>


<script type="text/javascript">
	 	$(".input").focus(function() {
	 		$(this).parent().addClass("focus");
	 	})

var full_name = $("input[name=full_name]").val();

if(full_name != ''){

	$("#fullname").addClass("focus");
}

var phone = $("input[name=phone]").val();

if(phone != ''){

	$("#phone").addClass("focus");
}

var website = $("input[name=website]").val();

if(website != ''){

	$("#website").addClass("focus");
}


var description = $("input[name=description]").val();

if(description != ''){

	$("#description").addClass("focus");
}
	$("#logo").addClass("focus");

</script>

<script>
    if ($('#ss_dropzone').length){
      var myDropzone = new Dropzone("#ss_dropzone", {
        url: "<?php echo base_url();?>client/image_upload",
        maxFiles: 1,
        maxFilesize: 100,
        method:"post",
        // acceptedFiles:"jpg|gif|png",
        paramName:"userfile",
        timeout: 18000000,
        dictInvalidFileType:"Invalid file type",
        addRemoveLinks:true,
        init: function () {
          var count = 0;
          thisDropzone = this;
          this.on("success", function (file, json) {

            var obj = json;
           
            var txt='<input  type="hidden" name="logo" value="'+obj.file_name+'" >';
            $('#addFileName').append(txt);

          });
 this.on("removedfile", function(file){
 	// alert(file.name);
 	           $.ajax({
                url: "<?php echo base_url(); ?>portfolio/main_image_remove?file="+file.name,
                success: function(results){
                   // alert(results);
                }
            });
  });

          this.on("queuecomplete", function (file) {
            $('.btn-addnew').prop("disabled", false);       
          }); 
          this.on("error", function (file, message, xhr) {
            console.log(message);
            var header = JSON.parse(xhr.response);
            $(file.previewElement).find('.dz-error-message').text(message.error);
          }); 
        },


      });

    }
</script>
