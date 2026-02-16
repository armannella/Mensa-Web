<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Programming course project">
    <meta name="author" content="Arman Khademi">
    <title>Canteen Dashboard</title>
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
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end column-gap-3">
                        <div class="leftprofile d-flex flex-column justify-content-center">
                            <h4 class="profile-title"><?php echo $_SESSION['name'] ?></h4>
                            <h4 class="profile-desc"><?php echo $_SESSION['user'] ?></h4>
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
                            <a href="index.php?page=foods" class="tile bgc-green"> 
                                <i class="bi bi-fork-knife"></i>
                                <span>Add Food</span>
                            </a>
                        </div>

                        <div class="col-md-3 mb-2">
                            <a href="index.php?page=show-addmenu" class="tile bgc-blue"> 
                                <i class="bi bi-menu-up"></i>
                                <span>Add Menu</span>
                            </a>
                        </div>

                        <div class="col-md-3 mb-2">
                            <a href="index.php?" class="tile bgc-orange"> 
                                <i class="bi bi-pc-display-horizontal"></i>
                                <span>Reports</span>
                            </a>
                        </div>

                        <div class="col-md-3 mb-2">
                            <a href="index.php?logout" class="tile bgc-purple"> 
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    
</body>
</html>