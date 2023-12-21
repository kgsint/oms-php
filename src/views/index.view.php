<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- bootstrap JS -->
    <script src="/js/bootstrap.bundle.js"></script>
    <title>OMS</title>
</head>
<body>
   <div class="container-fluid" style="height: 90vh;">
    <div class="row g-0">
        <!-- side navigation -->
        <?php require __DIR__ . "/side_navigation.php" ?>
        <!-- main section -->
        <main class="col-10 bg-secondary">
           <!-- navbar -->
           <?php require __DIR__ . '/navbar.php'; ?>

           <div class="container-fluid mt-3 p-4">
              <div class="row flex-column flex-lg-row">
                <h2 class="h6 text-white-50">
                    Stats
                </h2>
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">
                                103,567
                            </h3>
                            <span class=" text-muted">
                                Total Customers
                            </span>
                        </div>
                    </div>
                </div>    
                <div class="col">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title">2,354,353</h3>
                                <span class="text-muted">
                                    Total Orders
                                </span>
                            </div>
                        </div>
                </div>
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-muted">33,435,5663</h3>
                            <span class="text-success">
                                Total Products
                            </span>
                        </div>
                    </div>
                </div>
              </div>

              <div class="mt-4">
                <div class="">
                    <h2 class="h6 text-white-50">Latest Orders</h2>

                    <div class="card mb-3" style="height:280px;">
                       <div class="card-body" style="overflow:auto;">
                          <div class="text-end">
                            <!-- search -->
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search..." />
                                    <button class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                          </div>

                          <table class="table">
                            <tr>
                                <th>#ID</th>
                                <th>Product</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                            <tr>
                                <td>#24dfop322</td>
                                <td>Shirt</td>
                                <td>3000</td>
                                <td>Pending</td>
                                <td>
                                    <a class="link">Update Status</a>
                                </td>
                            </tr>
                          </table>
                       </div>
                    </div>
                </div>
              </div>
           </div>
        </main>
    </div>
   </div>
   <footer class="text-center py-4 text-muted mt-auto">
    &copy; Copyright 2023
   </footer>
</body>
</html>