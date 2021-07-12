<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
</head>
<body>
<section style="padding-top:60px;">
  <div class="container">
       <div class="row">
         <div class="col-md-12">
              <div class="card">
                   <div class="card-header">
                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#studentModal">Add New Student</a>
                   </div>
                   <div class="card-body">
                       <table id="studentTable" class="table">
                         <thead>
                            <tr>
                               <th>First Name</th>
                               <th>Last Name</th>
                               <th>Email</th>
                               <th>Phone</th>
                               <th>Action</th>
                            </tr>
                         </thead>
                               
                         <tbody> 
                         @foreach($students as $student)                                   
                             <tr id="sid{{$student->id}}">
                                <td>{{$student->firstname}}</td>
                                <td>{{$student->lastname}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td >
                                  <a href="javascript:void(0)"  onclick="editStudent({{$student->id}})"class="btn btn-info">Edit</a>
                                  <a href="javascript:void(0)"  onclick="deleteStudent({{$student->id}})"class="btn btn-danger">Delete</a>
                              </td>

                             </tr>                          
                        @endforeach
                         </tbody>                    
                    </table> 
                   </div>
              </div>
         </div>
       </div>
  </div>   
</section>
 <!--Add student Modal-->
<div class="container">
  <div class="modal" id="studentModal">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Student</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
                <!-- Modal body -->
        <div class="modal-body" >
          <form id="studentForm">
            @csrf
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" required>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" required>
            </div>
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
              <label for="Phone">Phone</label>
              <input type="tel" class="form-control" id="phone" required>
            </div>
            <button type="submit" class="btn btn-primary">submit</button>
          </form>
        </div>        
        <!-- Modal footer
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>         -->
      </div>
    </div>
  </div>  
</div>




 <!--Edit student Modal-->
<div class="container">
  <div class="modal" id="studentEditModal">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Student</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
                <!-- Modal body -->
        <div class="modal-body" >
          <form id="studentEditForm">
            @csrf
            <input type="hidden" id="id" name="id"/>
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname2" required>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname2" required>
            </div>
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" class="form-control" id="email2" required>
            </div>
            <div class="form-group">
              <label for="Phone">Phone</label>
              <input type="tel" class="form-control" id="phone2" required>
            </div>
            <button type="submit" class="btn btn-primary">submit</button>
          </form>
        </div>        
        <!-- Modal footer
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>         -->
      </div>
    </div>
  </div>  
</div>





<!-- //insert data in database -->
<script>
  $("#studentForm").submit(function(e){
  e.preventDefault();
  let firstname=$("#firstname").val();
  let lastname=$("#lastname").val();
  let email=$("#email").val();
  let phone=$("#phone").val();
  let _token=$("input[name=_token]").val();
  $.ajax({
      url:"{{route('student.add')}}",
      type:"POST",
      data:{
          firstname:firstname,
          lastname:lastname,
          email:email,
          phone:phone,
          _token:_token
      },
      success:function(response){
          if(response){
              $("#studentTable tbody").prepend('<tr><td>'+response.firstname+'</td><td>'+response.lastname+'</td> <td>'+response.email+'</td><td>'+response.phone+'</td></tr>');
              $("#studentForm")[0].reset();
              $("#studentModal").modal('hide');
          }
      }
  });
  });
</script>
<!-- //show data in edit form -->
<script>
    function editStudent(id){
      $.get('/students/'+id, function(student){
        $("#id").val(student.id);
          $("#firstname2").val(student.firstname);
            $("#lastname2").val(student.lastname);
              $("#email2").val(student.email);
                $("#phone2").val(student.phone);
                $("#studentEditModal").modal('toggle');
      });
    }
  </script>
<!-- //update data -->
  <script>
  $("#studentEditForm").submit(function(e){
  e.preventDefault();
  let id=$("#id").val();
  let firstname=$("#firstname2").val();
  let lastname=$("#lastname2").val();
  let email=$("#email2").val();
  let phone=$("#phone2").val();
  let _token=$("input[name=_token]").val();
  $.ajax({
      url:"{{route('student.update')}}",
      type:"PUT",
      data:{
        id:id,
          firstname:firstname,
          lastname:lastname,
          email:email,
          phone:phone,
          _token:_token
      },
      success:function(response){
          if(response){
              $('#sid'+response.id+'td:nth-child(1)').text(response.firstname);
              $('#sid'+response.id+'td:nth-child(2)').text(response.lastname);
              $('#sid'+response.id+'td:nth-child(3)').text(response.email);
              $('#sid'+response.id+'td:nth-child(4)').text(response.phone);
               $("#studentEditModal").modal('toggle');
               $("#studentEditForm")[0].reset();
          }
      }
  });
  });
</script>
<script>
    function deleteStudent(id){
      if(confirm("do you want to delete this record?"))
      {
        $.ajax({
          url:'/students/'+id,
          type:'DELETE',
          data:{
            _token:$("input[name=_token").val()
          },
          success:function(response){
            $("#sid"+id).remove();
          }

        });
      }
    }
</script>
</body>
</html>
