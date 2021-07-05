<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>SIMPLE CRUD APPLICATION</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    

<link href="<?php echo base_url(); ?>style/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<div class="content">
		<h1>Simple CRUD Application</h1>
		<?php echo $message; ?>
		<div id="pagination_to_load" class="paging"><?php echo $pagination; ?></div>
<!-- 		<div id="pagination_to_load" class="paging"></div> -->
		<div id="table_to_load" class="data"><?php echo $table; ?></div>
<!-- 		<div id="table_to_load" class="data"></div> -->
		<br />
		<?php echo anchor('person/add/','add new data',array('class'=>'add','data-toggle'=>'modal','data-target'=>'#myModal')); ?>
	</div>
</body>




    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>


</html>







<script type="text/javascript" language="javascript" >
$(document).ready(function(){
  
  function load_data()
  {
    $.ajax({
      url:"http://localhost:8080/ci2/index.php/person/index",
      dataType:"html",
      success:function(data){
//         $('#asas').html(data); 

          $('#pagination_to_load').html($(data).find('#asus').html());
          $('#table_to_load').html($(data).find('#asas').html());

//             var tableHtml = '<table>';
//                 tableHtml += '<tr>';
//                 tableHtml += '<th> No </th>';
//                 tableHtml += '<th> Name </th>';
//                 tableHtml += '<th> Gender </th>';
//                 tableHtml += '<th> Date of birth </th>';
//                 tableHtml += '<th> Action </th>';
//                 tableHtml += '</table>';
//                 $('#asas').html(tableHtml);
//                 alert(data[0].title);
               

//         $('#asas').html($(data).find('#asas').html());
      },
      error: function(xhr, ajaxOptions, thrownError){
         alert(thrownError);
      }
    });
  }

  load_data();

    $(document).on('click', '#btn_edit', function(){
     
     var name = $('#nm').val();
     var id = $('#idd').val();
     var gender = $('#gnd').val();
     var dob = $('#dobb').val();
//      alert(name);
    $.ajax({
      url:"http://localhost:8080/ci2/index.php/person/updatePerson",
      dataType:"json",
      method:"POST",
      data:{id:id, name:name, gender:gender,dob:dob},
      success:function(data){
//       alert("asas");
        $('#succ').html(data.message);
//         alert(data.message);
      },
      error: function(xhr, ajaxOptions, thrownError){
         alert(thrownError);
      }
    })
  });

  
    $(document).on('click', '#btn_add', function(){
     
     var name = $('#nm').val();
     var id = $('#idd').val();
     var gender = $('#gnd').val();
     var dob = $('#dobb').val();
//      alert(name);
    $.ajax({
      url:"http://localhost:8080/ci2/index.php/person/addPerson",
      dataType:"json",
      method:"POST",
      data:{id:id, name:name, gender:gender,dob:dob},
      success:function(data){
//       alert("asas");
        $('#succ').html(data.message);
//         alert(data.message);
      },
      error: function(xhr, ajaxOptions, thrownError){
         alert(thrownError);
      }
    })
  });
  
});
</script>
