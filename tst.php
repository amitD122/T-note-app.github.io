<?php
$insert = false;
$delete = false;
$update = false;
//connect to the database
$Servername = "localhost";
$Username = "root";
$password = "";
$database = "Curd_app";

$conn = mysqli_connect($Servername, $Username, $password, $database);
//   if(!$conn){
//      die("cannot connect to the database". mysqli_connect_error());

//  }
//  else{
//      echo "c0onnected";
// 
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `curd` WHERE `curd`.`S_no` = $sno";
    $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['snoedit'])) {
        // update the record.
        $sno = $_POST['snoedit'];
        $title = $_POST['Titleedit'];
        $description = $_POST['Descriptionedit'];

        $sql = "UPDATE `curd` SET `Title` = '$title' , `Description` = '$description'  WHERE `curd`.`S_no` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
        }
    } else {

        $title = $_POST['Title'];
        $description = $_POST['Description'];

        $sql = "INSERT INTO `curd` (`Title`, `Description`) VALUES ( '$title', ' $description ')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;
        } else {
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">




    <title>Tnote app</title>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/test/tst.php" method="POST">
                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="mb-3">
                            <label for="Title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="Titleedit" name="Titleedit" Required>
                        </div>
                        <div class="mb-3">
                            <label for="Description" class="form-label">Note Description</label>
                            <textarea class="form-control" id="Descriptionedit" name="Descriptionedit"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update a Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid bg-light">
            <a class="navbar-brand" href="#">Taking Note</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="Success">
                                    <strong>success!</strong> Your note has been added.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
    }
    if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="Success">
                                    <strong>success!</strong> Your note has been deleted.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
    }
    if ($update) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="Success">
                                    <strong>success!</strong> Your note has been updated successfully.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
    }
    ?>

    <div class="container my-4">
        <h3>Add a Note here</h3>
        <form action="/test/tst.php" method="POST">
            <div class="mb-3">
                <label for="Title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="Title" name="Title" Required>
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Note Description</label>
                <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add a Note</button>
        </form>
    </div>
    <div class="container my-4">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `curd`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo  '<tr>
                 <th scope="row">' . $sno . '</th>
                 <td>' . $row["Title"] . '</td>
                 <td>' . $row["Description"] . '</td>
                 <td> <button class="edit btn btn-sm btn-primary" id=' . $row["S_no"] . '>Edit</button>  
                 <button class="deletes btn btn-sm btn-primary" id=d' . $row["S_no"] . '>Delete</button> 
                 </td>
               </tr>';
                }
                // '.$row['S_no'].'
                ?>


            </tbody>
        </table>
    </div>
    <hr>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
    </script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            desc = tr.getElementsByTagName("td")[1].innerText;
            console.log(title, desc);
            Titleedit.value = title;
            Descriptionedit.value = desc;
            snoedit.value = e.target.id;
            console.log(e.target.id)
            $('#editModal').modal('toggle');
        })

    })

    deletes = document.getElementsByClassName('deletes');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit", );
            sno = e.target.id.substr(1, );

            if (confirm("Are you sure you want to delete this note")) {
                console.log("yes");
                window.location = `/test/tst.php?delete= ${sno}`;

                //create a form and use post request in the form.

            } else {
                console.log("no");
            }
        })

    })
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
</body>

</html>