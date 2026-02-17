<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Programming course project">
    <meta name="author" content="Arman Khademi">
    <title>Delivere Foods</title>
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
                        <h1 class="page-title">Delivere Foods</h1>
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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <h3 class="mb-4">Check Code</h3>
                        <form action="" id="checkForm">
                            <label for="menu_date" class="form-label">menu date</label>
                            <input type="date" name="menu_date" id="menu_date" class="form-control mb-3" required>

                            <label for="meal" class="form-label">meal</label>
                            <select name="meal" id="meal" class="form-select mb-3" required>
                                <option value="lunch">Lunch</option>
                                <option value="dinner">Dinner</option>
                            </select>

                            <label for="reserveID" class="form-label">Student Code</label>
                            <input type="text" class="form-control mb-5" name="reserveID" id="reserveID" placeholder="Student Code" required>

                            <input type="submit"  class="dokme bgc-green mb-3" value="Check !">
                        </form>
                        <hr>
                    </div>


                    <div class="col-md-7" id="contents">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <footer class="footer">
        <a href="index.php?page=welcome"><i class="bi bi-windows"></i></a>
    </footer>
    
    <script src="assets/js/deliverfood.js"> </script>
</body>
</html>