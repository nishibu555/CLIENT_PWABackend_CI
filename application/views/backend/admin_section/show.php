<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="myController">

    <!-- Page Heading -->

       <h3 class="h3 mb-2 text-gray-500">Dashboard / Admin</h3>

               <th>Name</th>
        <a href="<?php echo base_url(); ?>admin/add" class="btn btn-info float-right">Add New</a>
			<br>
			<table class="table" id="m_datatable_portfolio_section">

			</table>

 </div>
  
<script >

$(document).ready(function() {

    var table = $('#m_datatable_portfolio_section').DataTable( {
        // "processing": true,
        "processing":true,
        // "ajax": "testimonial-list",
        "ajax": {
	        "url": '<?php echo base_url(); ?>admin/get_all_admin_data',
	        "type": 'POST',
	    },
        
        "serverSide": true,
        // "paging":true,
        "info": true,
        "columns": [
			       {
			          "data": "id",
			          "title": "ID",
			          "sortable": true,
			          "filterable": false,
			          "width": 85,
			          "textAlign": 'center',
			        },
			       {
			          "data": "first_name",
			          "title": "First Name",
			          "sortable": true,
			          "filterable": true,
			          "width": 85,
			          "textAlign": 'center',
			        },
			       {
			          "data": "last_name",
			          "title": "Last Name",
			          "sortable": true,
			          "filterable": true,
			          "width": 85,
			          "textAlign": 'center',
			        },
			       {
			          "data": "email",
			          "title": "Email",
			          "sortable": true,
			          "filterable": false,
			          "width": 85,
			          "textAlign": 'center',
			        },
			       {
			          "data": "action",
			          "title": "Action",
			          "sortable": true,
			          "filterable": false,
			          "width": 85,
			          "textAlign": 'center',

			        },
        ]
    });//datatable end

});//document ready end
</script>

<script>


// function showMe(id){
//   $.ajax({
//   	url: "portfolio/show_me/"+id,
//   	 success: function(response){
//     location.reload();

//   }});
// }
// function hideMe(id){
//   $.ajax({
//   	url: "portfolio/hide_me/"+id,
//   	 success: function(response){
//     	location.reload();

//   }});
// }



</script>

