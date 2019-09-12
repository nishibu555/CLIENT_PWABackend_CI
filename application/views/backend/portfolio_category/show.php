<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="myController">

    <!-- Page Heading -->

       <h3 class="h3 mb-2 text-gray-500">Dashboard / portfolio</h3>

               <th>Name</th>
        <a href="<?php echo base_url(); ?>portfolio/category/add" class="btn btn-info float-right">Add New</a>
			<br>
			<table class="table" id="m_datatable_portfolio_section">
			<!--         <thead>
			            <tr>
			                <th>ID</th>
			                <th>Phone</th>
			                <th>Website</th>
			                <th>Description</th>
			                <th>Salary</th>
			            </tr>
			        </thead> -->
			</table>

 </div>
  
<script >

$(document).ready(function() {

    $('#m_datatable_portfolio_section').DataTable( {
        "processing": true,
        "ajax": "<?php echo base_url(); ?>portfolio-category-list",
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
			          "data": "name",
			          "title": "Name",
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


function showMe(id){
  $.ajax({
  	url: "portfolio/show_me/"+id,
  	 success: function(response){
    location.reload();

  }});
}
function hideMe(id){
  $.ajax({
  	url: "portfolio/hide_me/"+id,
  	 success: function(response){
    	location.reload();

  }});
}



</script>

