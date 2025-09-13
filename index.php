<?php

// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'Learn flutter', 'After react js learn flutter and dart\r\n', current_timestamp());
 
$insert=false; 
$update=false;
$delete=false;


 $servername="localhost";
 $username="root";
 $password="";
 $database="notes";

 $conn=mysqli_connect($servername,$username,$password,$database);
 if(!$conn){
 die("Sorry we failed to connect to database".mysqli_connect_error());
 }
 
//  echo $_SERVER['REQUEST_METHOD'];

// echo $_GET['update'];
// echo $_POST['snoEdit'];

 if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `sno` = $sno";
  $result=mysqli_query($conn,$sql);
 }


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    $sno=$_POST['snoEdit'];
    $title=$_POST['titleEdit'];
  $description=$_POST['descriptionEdit'];
   
  $sql="UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes` . `sno` = $sno";
 $result=mysqli_query($conn,$sql);
  if($result){
    $update=true;
  }else{
    echo "We could not update the record successfully";
  }

  }else{

  $title=$_POST['title'];
  $description=$_POST['desc'];
   
  $sql="INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$description')";
 $result=mysqli_query($conn,$sql);

 if($result){
  // echo "The record has been inserted succesfully <br>";
  $insert=true;
 }else{
  echo "The record was not inserted succesfully because of this error" .mysqli_error($conn);
 }

  }
 }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP-CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
     

    <script src="//cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
  </head>

  <style> 

   body {
  margin: 0;
  padding: 0;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364, #1b2735);
  /* background-size: 300% 300%; */
  animation: gradientBG 15s ease infinite;
  color: #fff; /* for text contrast */
}

@keyframes gradientBG {
  0%   { background-position: 0% 50%; }
  50%  { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}


   
    .welcome-heading {
  font-size: 2.5rem;
  font-weight: bold;
  text-transform: uppercase;
  background: linear-gradient(90deg, #ff6a00, #ee0979, #007bff);
  background-size: 300% 300%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientMove 5s ease infinite;
  text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
  margin: 20px 0;
}

@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

 

  </style>
  <body>

   <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit iNotes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      <form action="/Saksham first php/PhpProject/index.php" method="post">
       <input type="hidden" name="snoEdit" id="snoEdit">

  <div class="mb-3">
    <label for="title" class="form-label">Note Title</label>
    <input type="text" class="title" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Note Description</label>
     <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Update Note</button>

  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
</form>


      </div>
      
    </div>
  </div>
</div>

   <!-- End Modal -->


   <h2 class="welcome-heading text-center">
  Welcome to YoNotes App <br> Made By Saksham Khadka
</h2>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<?php
 
if($insert){
   echo "
    
   <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Inserted notes Successfully</strong> You should check in on some of those fields below.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
   
   ";
}

if($delete){
   echo "
    
   <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Deleted notes Successfully</strong> You should check in on some of those fields below.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
   
   ";
}

if($update){
   echo "
    
   <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Updated notes Successfully</strong> You should check in on some of those fields below.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
   
   ";
}


?>


 <div class="container my-5">
 <h2>Add a Note</h2>
    <form action="/Saksham first php/PhpProject/index.php " method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Note Title</label>
    <input type="text" class="title" id="title" name="title" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Note Description</label>
     <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
 </div>
 
 <div class="container my-4">
    <?php
    
   $sql="SELECT * FROM `notes`";
   $result=mysqli_query($conn,$sql);


    ?>
    
    <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">SNO</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   
      <?php
    
   $sql="SELECT * FROM `notes`";
   $result=mysqli_query($conn,$sql);
    $serial = 0;
while($row = mysqli_fetch_assoc($result)) {
    $serial++;
    echo "<tr>
      <th scope='row'> " . $serial ." </th>
      <td>" . $row['title'] ."</td>
      <td>" . $row['description'] ."</td>
      <td>
        <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
        <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
      </td>
    </tr>";
}

    ?>

    
    
  </tbody> 
</table>
<hr>

 </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
  <script>
    	
let table = new DataTable('#myTable');
  </script>

   <script>
  
  // Use event delegation for Edit
document.querySelector('#myTable').addEventListener('click', function(e) {
  if (e.target && e.target.classList.contains('edit')) {
    console.log("edit");
    const tr = e.target.closest('tr');
    const title = tr.getElementsByTagName("td")[0].innerText;
    const description = tr.getElementsByTagName("td")[1].innerText;

    titleEdit.value = title;
    descriptionEdit.value = description;
    snoEdit.value = e.target.id;

    console.log(e.target.id);
    $('#editModal').modal('toggle');
  }
});

// Use event delegation for Delete
document.querySelector('#myTable').addEventListener('click', function(e) {
  if (e.target && e.target.classList.contains('delete')) {
    console.log("delete");
    const sno = e.target.id.substr(1);
    const tr = e.target.closest('tr');
    const title = tr.getElementsByTagName("td")[0].innerText;

    if (confirm("Are you sure you want to delete this note?")) {
      window.location = `/Saksham first php/PhpProject/index.php?delete=${sno}`;
    }
  }
});

  


    </script>


  </body>
</html>