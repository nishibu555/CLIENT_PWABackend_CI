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
				<form action="<?php echo base_url();?>pages/about_us/update/<?php echo $about[0]['id'];?>" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<h1>Contact Page Settings</h1>
							</div>
						</div>
						<br>
						

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox focus">
									<div class="inputText ">Title</div>
									<input type="text" name="title" class="input" value="<?php echo $about[0]['title']?>">
									<div class="err_msg"><?php echo form_error('title'); ?></div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox">
									<div id="addFileName"></div>
									<!-- <div class="inputText">Main Image</div> -->
				            <div class="m-dropzone dropzone m-dropzone--primary" id="dropzone_testimonial">
				                <div class="m-dropzone__msg dz-message needsclick">

				                    <div style="width: 70%; margin: 20px auto;">
				                       <img style="height: 120px; width: 120px" src="<?php echo base_url();?>assets/uploads/pages/<?php echo $about[0]['image']?>">
				                 </div>
				                 <h4>Image</h4>
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
									<div class="inputText">Content</div>
									 <textarea id="summernote" name="content"><?php echo $about[0]['content']?></textarea>
									<div class="err_msg"><?php echo form_error('content'); ?></div>
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


$(document).ready(function() {
  $('#summernote').summernote({
      callbacks: {
        onChange: function(contents, $editable) {
         contents = $(contents).text();
         var substr = contents.substring(0,39);

         $('#preBod').val(contents);
         $('textarea[name="metatag"]').val(substr);
         $('textarea[name="social_desc"]').val(substr);
         $('textarea[name="social_desc2"]').val(substr);
       },
    onBlur: function() {
      console.log('Editable area loses focus');
      $('.note-editor').css('z-index', '1050');

    },
    onFocus: function() {
      $('.note-editor').css('z-index', '999');
    }
    },
  tabsize: 2,
  height: 100
  });

});
</script>

<script>
  $(document).ready(function () {
    // $( ".ss_steps" ).css( "overflow", "inherit" );

    if ($('#dropzone_testimonial').length){
      var myDropzone = new Dropzone("#dropzone_testimonial", {
        url: "<?php echo base_url();?>pages/about_us_image_upload",
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
            var txt='<input  type="hidden" name="aboutus_image" value="'+obj.file_name+'" >';
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

});
</script>