<!-- Begin Page Content -->
<div class="container-fluid" ng-controller="myController">

    <!-- Page Heading -->

       <h3 class="h3 mb-2 text-gray-500">Dashboard / Clients</h3>

               <th>Name</th>
        <a href="client/add" class="btn btn-info float-right">Add New</a>
			<br>
			<table class="table" id="m_datatable_client_section">
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

    $('#m_datatable_client_section').DataTable( {
        "processing": true,
        "ajax": "clients-list",
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
			          "data": "phone",
			          "title": "Phone",
			          "sortable": true,
			          "filterable": false,
			          "width": 85,
			          "textAlign": 'center',
			        },
			       {
			          "data": "website",
			          "title": "Website",
			          "sortable": true,
			          "filterable": false,
			          "width": 85,
			          "textAlign": 'center',
			        },
			       {
			          "data": "show_hide",
			          "title": "Show On Home",
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
  	url: "client/show_me/"+id,
  	 success: function(response){
    location.reload();

  }});
}
function hideMe(id){
  $.ajax({
  	url: "client/hide_me/"+id,
  	 success: function(response){
    	location.reload();

  }});
}



</script>

