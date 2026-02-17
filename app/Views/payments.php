<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Programming course project">
    <meta name="author" content="Arman Khademi">
    <title>Wallet</title>
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
                        <h1 class="page-title">Wallet</h1>
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

                        <div class="tile bgc-orange mb-4">
                            <i class="bi bi-wallet2"></i>
                            <span id="balance">0 Euro</span>
                        </div>
                        <hr>
                        <h3 class="mb-4">Charge Your Wallet</h3>
                        <form action="" id="addmoneyForm">
                            <label for="amount" class="form-label">Amount &euro;</label>
                            <input type="number" name="amount" id="amount" class="form-control mb-2" placeholder="min=1 euro" min="1" required>

                            <label for="method" class="form-label">Payment Method</label>
                            <select class="form-select mb-4" id="method" name= "method" required>
                                <option selected value="1">Visa</option>
                                <option value="2">MasterCard</option>
                                <option value="3">Shaparak</option>
                            </select>
                            <input type="submit"  class="dokme bgc-green mb-3" value="Top up Account !">
                        </form>

                        <hr>
                    </div>


                    <div class="col-md-7">
                        <h3>History of Transactionss</h3>
                        
                        <div id="transactionlists"> 
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>type</th>
                                        <th>amount</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionslist">
                                    
                                </tbody>
                            </table>
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
    
    <script src="assets/js/payments.js"> </script>
</body>
</html>
