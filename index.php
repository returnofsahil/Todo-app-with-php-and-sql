<?php

$insert = false;
$delete = false;
$update =false;
require_once('connection.php');
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  
  $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
  $result= mysqli_query($conn,$sql);
  $delete = true;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    // update record
    // echo 'yes';
    $title = $_POST['titleEdit'];
    $description = $_POST['descEdit'];
    $sno = $_POST['snoEdit'];
    $update =true;
    //updating db
    $sql ="UPDATE `notes` SET `title` = '$title' ,`description` = '$description'  WHERE `sno` = '$sno'";
    $result = mysqli_query($conn,$sql);
  }
  else{
    $title = $_POST['title'];
    $description = $_POST['desc'];
  
  //posting to database
    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn,$sql);
    if($result){
      $insert = true;
    }
   else{
     $insert = false;
   }
  }
  
  
  

  
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- jquery -->
    <!-- data table jquery plug in -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
  </head>
  <body>
    <!-- modal -->
       <!-- edit mdal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method='POST' action='index.php'>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input
            type="text"
            class="form-control"
            name="titleEdit"
            id="titleEdit"
            aria-describedby="emailHelp"
          />
          <input type="hidden"name="snoEdit"id ="snoEdit">
        </div>
        
        </div>
        <div class="form-floating">
          <textarea 
          class="form-control " 
          name="descEdit"
          placeholder="Leave a comment here" id="descEdit" 
           >
          </textarea>
          <label for="desc">Description</label>
        </div>
        <div class="container d-flex justify-content-center">
          
          <button type="submit" class="btn btn-primary my-3 mx-3 ">Update Note</button>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
    <!-- modal end -->
    <!--Bootstrap  -->
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li>
          </ul>
          
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>
    <!-- alert -->
    <?php
              
              if($insert){
                echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success</strong> Your note has been added
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
              
              }
              
          ?>
          <?php
              
              if($delete){
                echo"<div class='alert alert-info alert-dismissible fade show' role='alert'>
                <strong>Success</strong> Your note has been deleted
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
              
              }
              
          ?><?php
              
          if($update){
            echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success</strong> Your note has been updated
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
          
          }
          
      ?>
    <!-- alert -->
    <!-- form -->
    <div class="container my-4">
      <h2>Add Note</h2>
      <form method='POST' action='index.php'>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input
            type="text"
            class="form-control"
            name="title"
            id="title"
            aria-describedby="emailHelp"
          />
        </div>
        
        </div>
        <div class="form-floating">
          <textarea 
          class="form-control " 
          name="desc"
          placeholder="Leave a comment here" id="desc" 
           >
          </textarea>
          <label for="desc">Description</label>
        </div>
        <div class="container d-flex justify-content-center">
          
          <button type="submit" class="btn btn-primary my-3 mx-3 ">Submit</button>
        </div>
        
      </form>
    </div>
    <!-- php -->
    <div class="container my-4">
      
      <!-- table -->
      <table class="table"id="myTable">
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Title</th>
            <th scope="col">Descrption</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php 
      $sql="SELECT * FROM `notes`";
      $result = mysqli_query($conn,$sql);
      $sno=0;
      while($row = mysqli_fetch_assoc($result)){
        $sno +=1; 
        echo('<tr>
            <th scope="row">'. $sno .'</th>
            <td>'. $row["title"] .'</td>
            <td>' .$row["description"] .'</td>
            <td>
            <button class="btn btn-sm btn-primary edit" id =' .$row["sno"] .'>Edit</button> 
            <button class="btn btn-sm btn-danger delete" id=d' .$row["sno"] .'>Delete</button>
            </td>
          </tr>');
          

      }
      ?>
        
          
        </tbody>
      </table>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
    <script>
      edits = document.getElementsByClassName('edit');
      
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
           tr =e.target.parentNode.parentNode;
           title = tr.getElementsByTagName('td')[0].innerText;
           desc = tr.getElementsByTagName('td')[1].innerText;
           titleEdit.value = title;
           descEdit.value = desc;
           snoEdit.value=e.target.id;
           console.log(e.target.id);
           $('#editModal').modal('toggle');
          
        })
      })
      
      // delete
      deletes = document.getElementsByClassName('delete');
      
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
           
           sno=e.target.id.substr(1,);

           if(confirm("Press a button")){
             
             window.location = `/projects/todoPhp/index.php?delete=${sno}`;
           }
           
          
        })
      })
     
    </script>
  </body>
</html>
