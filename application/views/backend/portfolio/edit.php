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


.m-dropzone.dropzone.m-dropzone--primary .m-dropzone__msg > div > div a{
    position: absolute;
    text-decoration: underline;
    left: 0;
    bottom: -65px;
    width: 100%;
    font-size: 13px;
    color: #4e73df;

}
.m-dropzone.dropzone.m-dropzone--primary .m-dropzone__msg > div > div {
	position: relative;
	    padding: 10px;
}
</style>
<div class="container-fluid" >

    <!-- Page Heading -->
       <h3 class="h3 mb-2 text-gray-500">Dashboard / Portfolio</h3>

       <a href="<?php echo base_url();?>portfolio" class="btn btn-info float-right"><i class="fas fa-list"></i> Portfolio List</a>
<br>
			<div class="formBox">
				<form action="<?php echo base_url();?>portfolio/update/<?php echo $portfoio[0]['id'];?>" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<h1>Edit Portfolio</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText focus" id="title">Portfolio title</div>
									<input type="text" name="title" class="input" value="<?php echo $portfoio[0]['title'];?>">
									<div class="err_msg"><?php echo form_error('title'); ?></div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText" id="website">Website Link</div>
									<input type="tel" name="website" class="input" value="<?php echo $portfoio[0]['website'];?>">
									<div class="err_msg"><?php echo form_error('website'); ?></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText" id="client">Client</div>
									<select type="text" name="client" class="input">
										<option></option>
										<?php foreach($clients as $client){?>
										<option value="<?php echo $client['id'];?>" <?php echo ($portfoio[0]['client_id'] == $client['id']) ? "selected":''; ?>><?php echo $client['name'];?></option>
									<?php } ?>
										
									</select>
									<!-- <div class="err_msg"><?php echo form_error('website'); ?></div> -->
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inputBox focus">
									<div class="inputText" id="category">Category</div>
									<select type="text" name="category" class="input">
										<option></option>
										<?php foreach($categories as $category){?>
										<option value="<?php echo $category['id'];?>" <?php echo ($portfoio[0]['category_id'] == $category['id']) ? "selected":''; ?>><?php echo $category['name'];?></option>
									<?php } ?>
										
									</select>
									<!-- <div class="err_msg"><?php echo form_error('website'); ?></div> -->
								</div>
							</div>
<!-- 							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Logo</div>
									<input type="file" name="logo" class="input">
									<div class="err_msg"><?php echo form_error('logo'); ?></div>
								</div>
							</div> -->
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox focus">
									<div class="inputText" id="description">Description</div>
									<textarea class="input" name="description"><?php echo $portfoio[0]['description'];?></textarea>
									<div class="err_msg"><?php echo form_error('description'); ?></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox focus">
									<div class="inputText focus" id="technology">Technology Used</div>
									<textarea class="input" name="technology"><?php echo $portfoio[0]['technology'];?></textarea>
									<div class="err_msg"><?php echo form_error('technology'); ?></div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox focus">
									<div id="addFileName"></div>
									<!-- <div class="inputText">Main Image</div> -->
				            <div class="m-dropzone dropzone m-dropzone--primary" id="ss_dropzone">
				                <div class="m-dropzone__msg dz-message needsclick">

				                    <div style="width: 70%; margin: 20px auto;">
				                    	<?php if(isset($main_image[0])){?>
				                      <img style="height: 120px;width: 120px" src="<?php echo base_url();?>assets/uploads/portfolio/main/<?php echo $main_image[0]['image'];?>" />
				                  <?php } ?>
				                 </div>
				                 <h4>Main Image</h4>
				                 <h3 class="m-dropzone__msg-title">Choose an image from your computer
				                 </h3>
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
								<div class="inputBox focus">
									<!-- <div class="inputText">Main Image</div> -->
									<div id="addFileName1"></div>
				            <div class="m-dropzone dropzone m-dropzone--primary" id="ss_dropzone2">
				                <div class="m-dropzone__msg dz-message needsclick">

							     <div style="width: 70%; margin: 20px auto;">
							     	<?php foreach($secondary_image as $img){?>
							     	<div style="display:inline;">
			 						<img style="height: 120px;width: 120px" src="<?php echo base_url();?>assets/uploads/portfolio/secondary/<?php echo $img['image'];?>" />
										<a onclick="removeServerImage(<?php echo $img['id'];?>)">Remove file</a>
			 						</div>
			 					<?php } ?>
				                 </div>
				                 <div id="image_edit_click">
				                 <h4>Secondary Images</h4>
				                 <h3 class="m-dropzone__msg-title">Choose an image from your computer
				                 </h3>
				                 <span class="m-dropzone__msg-desc">max 5 files</span>
				                 <div class="dz-error-message"><span data-dz-errormessage></span></div>
				             </div>
				             </div>
				         </div>
				         <div class="err_msg"><?php echo form_error('secondaryfile'); ?></div>
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

<script>
  $(document).ready(function () {
    // $( ".ss_steps" ).css( "overflow", "inherit" );

    if ($('#ss_dropzone').length){
      var myDropzone = new Dropzone("#ss_dropzone", {
        url: "<?php echo base_url();?>portfolio/main_image_upload",
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
            var txt='<input  type="hidden" name="portfolio_main_image" value="'+obj.file_name+'" >';
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


//secondary image dropzone

    // if ($('#ss_dropzone2').length){
      var myDropzone2 = new Dropzone("#ss_dropzone2", {
        url: "<?php echo base_url();?>portfolio/secondary_image_upload",
        maxFiles: <?php echo (5-count($secondary_image));?>,
        maxFilesize: 100,
        method:"post",
        // acceptedFiles:"jpg|gif|png",
        paramName:"secondaryfile",
        timeout: 18000000,
        dictInvalidFileType:"Invalid file type",
        addRemoveLinks:true,
        clickable:"#image_edit_click",
        init: function () {
          var count = 0;
          thisDropzone = this;
          this.on("success", function (file, json) {
          		
            var obj = json;
            var txt='<input  type="hidden" name="portfolio_secondary_image[]" value="'+obj.file_name+'" >';
            $('#addFileName1').append(txt);

          });
 this.on("removedfile", function(file){

 	           $.ajax({
                url: "<?php echo base_url(); ?>portfolio/secondary_image_remove?file="+file.upload.filename,
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

    // }

});




var title = $("input[name=title]").val();

if(title != ''){

	$("#title").addClass("focus");
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
	function removeServerImage(id){
 	           $.ajax({
                url: "<?php echo base_url(); ?>portfolio/image_remove_from_server?id="+id,
                success: function(results){
                 location.reload();
                }
            });
	}
</script>