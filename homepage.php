<?php
session_start();
include("connect.php");

// Add or Update Company
if (isset($_POST['saveCompany'])) {
    $id = $_POST['id'] ?? null;
    $companyName = $_POST['company_name'];
    $category = $_POST['category'];
    $state = $_POST['state'];
    $email = $_POST['email'];

    if ($id) {
        // Update query
        $sql = "UPDATE companies SET 
                company_name='$companyName', 
                category='$category', 
                state='$state', 
                email='$email' 
                WHERE id=$id";
    } else {
        // Insert query
        $sql = "INSERT INTO companies (company_name, category, state, email) 
                VALUES ('$companyName', '$category', '$state', '$email')";
    }

    if ($conn->query($sql)) {
        header("Location: homepage.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

// Delete Company
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM companies WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: homepage.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch all companies
$companies = $conn->query("SELECT * FROM companies");

// Handle Edit Request
$company = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM companies WHERE id=$id");
    $company = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quick.</title>
    <!-- Font-Awesome  Link-up -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Bootstrap(5.3.1)  Link-up -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" />
    <!-- Font-cdn -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />

    <!-- CSS link -->
    <link rel="stylesheet" href="./css/homepage.css" />

</head>

<body>
    <div class="section-padding">
        <div class="container">
            <!-- Header logo and menu section start-->
            <div class="header-area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo">
                            <img src="assets/logo.jpg" alt="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menuarea text-end">
                            <ul>
                                <li><a href="index.html">Overviews</a></li>
                                <li><a href="index.html">Landings</a></li>
                                <li><a href="index.html">Pages</a></li>
                                <li><a href="index.html">Apps</a></li>
                                <li>
                                    <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header logo and menu section end-->

            <!-- Team Member Details Section -->
            <div class="team-section section-padding">
                <div class="container">
                    <h3 class="text-center">Team Members</h3>
                    <div class="row">
                        <!-- Person 1 -->
                        <div class="col-md-6">
                            <div class="team-member">
                                <div class="member-image">
                                    <img src="./assets/person1.jpg" alt="Person 1" />
                                </div>
                                <div class="member-details">
                                    <h4>Adiba Rahman Orny</h4>
                                    <p>ID: 213-15-4395</p>
                                    <p>Department: Computer Science & Engineering</p>
                                    <p>University: Daffofil Internation University(DIU)</p>
                                </div>
                            </div>
                        </div>
                        <!-- Person 2 -->
                        <div class="col-md-6">
                            <div class="team-member">
                                <div class="member-image">
                                    <img src="./assets/person2.jpg" alt="Person 1" />
                                </div>
                                <div class="member-details">
                                    <h4>Foyez Ahmed</h4>
                                    <p>ID: 213-15-4429</p>
                                    <p>Department: Computer Science & Engineering</p>
                                    <p>University: Daffofil Internation University(DIU)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Home banner section start -->
            <div class="banner-area">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-title text-center">
                            <h2>
                                It's time to amplify your <br />
                                <span>online business</span>
                            </h2>
                        </div>
                        <div class="banner-heading text-center">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Temporibus, sed! <br />Lorem ipsum, dolor sit amet consectetur
                                adipisicing.
                            </p>
                        </div>
                        <div class="banner-image">
                            <img src="assets/banner.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Home banner section end -->

            <!-- Company details listing -->
            <div class="container mt-5">
                <h3>Company Details</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Category</th>
                            <th>State</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $companies->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['company_name'] ?></td>
                            <td><?= $row['category'] ?></td>
                            <td><?= $row['state'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <a href="homepage.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="homepage.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <h4 class="mt-4">Add / Edit Company</h4>
                <form method="POST" action="homepage.php">
                    <input type="hidden" name="id" value="<?= $company['id'] ?? '' ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="company_name" class="form-control" placeholder="Company Name"
                                value="<?= $company['company_name'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="category" class="form-control" placeholder="Category"
                                value="<?= $company['category'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="state" class="form-control" placeholder="State"
                                value="<?= $company['state'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="<?= $company['email'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="saveCompany" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>


</body>

</html>