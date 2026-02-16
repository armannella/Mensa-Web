<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Programming course project">
    <meta name="author" content="Arman Khademi">
    <title>Mensa App</title>
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
                    <div class="col-md-4">
                        <h1 class="page-title">Welcome</h1>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end column-gap-3">
                        <div class="leftprofile d-flex flex-column justify-content-center">
                            <h4 class="profile-title">Mensa Web Project</h4>
                            <h4 class="profile-desc">Arman Khademi</h4>
                        </div>
                        <div class="rightprofile d-flex flex-column justify-content-center">
                            <img src="assets/uploads/profiles/siteprofile.jpg" alt="Logo" width="60px" height="60px" >
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </header>



    <main>
        <div class="container-fluid pt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="index.php?page=student-signup" class="tile bgc-green"> 
                                <i class="bi bi-person-plus-fill"></i>
                                <span>Student Sign Up</span>
                            </a>
                        </div>

                        <div class="col-md-3 mb-2">
                            <a href="index.php?page=student-login" class="tile bgc-blue"> 
                                <i class="bi bi-person-check-fill"></i>
                                <span>Student Log in</span>
                            </a>
                        </div>

                        <div class="col-md-3 mb-2">
                            <a href="index.php?page=canteen-login" class="tile bgc-orange"> 
                                <i class="bi bi-fork-knife"></i>
                                <span>Canteen Log in</span>
                            </a>
                        </div>

                        <div class="col-md-3 mb-2">
                            <a href="https://www.linkedin.com/in/armannella/" class="tile bgc-purple"> 
                                <i class="bi bi-info-square"></i>
                                <span>About Me</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
   
    <footer class="footer">
        <a href="index.php?page=welcome"><i class="bi bi-windows"></i></a>
    </footer>   
</body>


</html>