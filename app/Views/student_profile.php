<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Programming course project">
    <meta name="author" content="Arman Khademi">
    <title>Student Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="shortcut icon" href="assets/uploads/profiles/siteprofile.jpg" type="image/x-icon">
</head>
<body>
    <header class="container-fluid mt-3 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-8">
                        <h1 class="page-title">Profile</h1>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end column-gap-3">
                        <div class="leftprofile d-flex flex-column justify-content-center">
                            <h4 class="profile-title"><?php echo $_SESSION['name'] ?></h4>
                            <h4 class="profile-desc"><?php echo $_SESSION['user'] ?></h4>
                        </div>
                        <div class="rightprofile d-flex flex-column justify-content-center">
                            <img src="assets/uploads/profiles/<?php echo $_SESSION['image'] ?>" alt="Logo" width="60px" height="60px" >
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </header>


    <main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <h3 class="mb-4">Change Password</h3>
                        <form action="" id="changepasswordForm">
                            <label for="oldpassword" class="form-label">Old PassWord</label>
                            <input type="password" class="form-control mb-2" name="oldpassword" id="oldpassword" placeholder="Your Old Password" required>

                            <label for="newpassword" class="form-label">New PassWord</label>
                            <input type="password" class="form-control mb-4" name="newpassword" id="newpassword" placeholder="Your New Password" required>

                            <input type="submit"  class="dokme bgc-green mb-3" value="chane password !">
                        </form>

                        <hr>

                        <h3 class="mb-4">Change Image</h3>
                        <form action="" id="changeimageForm" enctype="multipart/form-data">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class ="form-control mb-4" name="image" id="image" required>

                            <input type="submit"  class="dokme bgc-green mb-3" value="upload image !">
                        </form>
                    </div>


                    <div class="col-md-7">
                        <h3>Your Profile</h3>
                        
                        <div id="profilelist"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <footer class="footer">
        <a href="index.php?page=welcome"><i class="bi bi-windows"></i></a>
    </footer>
    
    <script src="assets/js/studentprofile.js"> </script>
</body>
</html>
