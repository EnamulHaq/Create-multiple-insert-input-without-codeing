<!DOCTYPE html>
<html>
<head>
	<title>Data Insert By AJAX</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="table-responsive">
			    <table class="table table-bordered" id="crud_table">
				    <tr>
				    	<th width="5%" >Serial No</th>
					    <th width="30%">Students Name</th>
					    <th width="10%">Students Roll</th>
					    <th width="45%">Department</th>
					    <th width="5%">Action</th>
				    </tr>
			     	<tr>
					    <td class="sn">1</td>
					    <td contenteditable="true" class="item_name" id="s_name"></td>
					    <td contenteditable="true" class="item_code" id="s_roll"></td>
					    <td contenteditable="true" class="item_desc" id="s_dep"></td>
					    <td style='padding: 24px;'></td>
			     	</tr>
			    </table>
			    <div class="text-center">
			     	<button type="button" name="save" id="save" class="btn btn-info">Save</button>
			     	<button type="button" name="add" id="add" class="btn btn-success btn-xs" style="width: 6%;font-size: 20px;">+</button>
			    </div>
			    <br />
			    <div id="inserted_item_data"></div>
			</div>
		</div>
	</div>
</body>

<script>

$(document).ready(function(){
 	var count = 0;
 	var i = 1;
	$('#add').click(function(){
	  	count = count + 1;
	  	i = i + 1;
	  	var html_code = "<tr id='row"+count+"'>";
	    html_code += "<td  class='sn'>"+i+"</td>";
	    html_code += "<td contenteditable='true'  id='s_name'></td>";
	    html_code += "<td contenteditable='true'  id='s_roll'></td>";
	    html_code += "<td contenteditable='true'  id='s_dep'></td>";
	    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove' style='font-size: 20px;width: 100%;'>-</button></td>";   
	    html_code += "</tr>";  
	   $('#crud_table').append(html_code);
	});
 
 	$(document).on('click', '.remove', function(){
	  	var delete_row = $(this).data("row");
	  	$('#' + delete_row).remove();
 	});
 
 	$('#save').click(function(){
 		var myId = $("#s_name").prop("id");
 		alert(myId);
		var name = [];
		var roll = [];
  		var dep = [];
		// $('#s_name').each(function(){
		//    	s_name.push($(this).text());
		// });

  //   	$('#s_name').each(function(){
  //  			s_roll.push($(this).text());
  // 		});

	 //    $('.item_desc').each(function(){
	 //   		s_dep.push($(this).text());
	 //  	});

  		$.ajax({
   			url:"insert.php",
   			method:"POST",
   			data:{item_name:item_name, item_code:item_code, item_desc:item_desc, item_price:item_price},
   			success:function(data){
    		alert(data);
    		$("td[contentEditable='true']").text("");
    		for(var i=2; i<= count; i++)
    		{
    			$('tr#'+i+'').remove();
    		}
    		fetch_item_data();
   			}
  		});
 	});
 
 	function fetch_item_data()
 	{
  		$.ajax({
   			url:"fetch.php",
   			method:"POST",
   			success:function(data)
   			{
    			$('#inserted_item_data').html(data);
   			}
  		})
 	}
 		fetch_item_data();
 
});
</script>

</html>


