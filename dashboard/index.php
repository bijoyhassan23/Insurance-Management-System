<?php
include_once('../includes/config.php');

session_start();  
if(!isset($_SESSION["username"])) {  
    header("location:../index.php?error");  
}  

if(isset($_POST["c_s_d"])){
    $acc = $_POST['acc_no'];
    header("location: history/client_saving_history.php?acc_no=".$acc);
}
if(isset($_POST["c_i_d"])){
    $loan = $_POST['loan_no'];
    header("location: history/client_installment_deposit_history.php?loan_no=".$loan);
}
if(isset($_POST["check_loan"])){
    $loan = $_POST['loan_no'];
    header("location: history/loan_status.php?loan_no=".$loan);
}
if(isset($_POST["check_client"])){
    $acc = $_POST['acc_no'];
    header("location: client/check_client.php?acc_no=".$acc);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - DKBSS</title>
    <link rel="shortcut icon" href="../image/favicon.png" />
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/fontawesome.css" rel="stylesheet">
    <script src="../js/sweetalert.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --info: #00b5d4;
            --light: #f8f9fa;
            --dark: #343a40;
            --sidebar-bg: #1a252f;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styles */
        .sidebar-wrapper {
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #0e151c 100%);
            box-shadow: 3px 0 25px rgba(0,0,0,0.15);
            transition: var(--transition);
        }

        .sidebar-heading {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            padding: 1.5rem;
            text-align: center;
            background: rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            letter-spacing: 2px;
        }

        .list-group-item {
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.85);
            padding: 0.9rem 1.5rem;
            transition: var(--transition);
            border-left: 4px solid transparent;
            font-weight: 500;
            margin: 2px 0;
        }

        .list-group-item:hover {
            background: rgba(255,255,255,0.08);
            color: white;
            border-left: 4px solid var(--primary);
            padding-left: 1.8rem;
        }

        .list-group-item.active {
            background: rgba(52, 152, 219, 0.15);
            color: white;
            border-left: 4px solid var(--primary);
        }

        .nav-active {
            background: rgba(52, 152, 219, 0.2) !important;
            color: white !important;
            border-left: 4px solid var(--primary) !important;
        }

        /* Alert Groups in Sidebar */
        .alert {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            margin: 0.5rem;
            padding: 0.5rem !important;
            border-radius: 8px !important;
        }

        /* Navbar Styles */
        .navbar {
            background: white !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 0.8rem 1.5rem;
            border-bottom: 1px solid #eaeaea;
        }

        #menu-toggle {
            background: var(--primary);
            color: white;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            transition: var(--transition);
            border: none;
            box-shadow: 0 2px 10px rgba(52, 152, 219, 0.3);
        }

        #menu-toggle:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }

        .welcome-alert {
            background: linear-gradient(135deg, var(--success) 0%, #229954 100%);
            border: none;
            border-radius: 12px;
            margin: 1rem;
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .welcome-alert marquee {
            padding: 0.8rem 0;
        }

        /* Card Styles */
        .stat-card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .stat-card-title {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stat-card-value {
            color: var(--dark);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-card-detail {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .stat-card-detail:hover {
            color: var(--secondary);
            text-decoration: none;
        }

        /* Check Cards */
        .check-card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            margin-bottom: 1.5rem;
            overflow: hidden;
            border-top: 4px solid;
        }

        .check-card:hover {
            transform: translateY(-3px);
        }

        .check-card-header {
            background: white;
            border-bottom: 1px solid #eaeaea;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .check-card-body {
            padding: 1.5rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #2980b9 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9 0%, #1f6396 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem !important;
            }
            
            .stat-card {
                margin-bottom: 1rem;
            }
            
            .stat-card-value {
                font-size: 1.5rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <div class="sidebar-heading">DKBSS</div>
            <div class="list-group list-group-flush">
                <span href="" class="unclickable nav-active list-group-item list-group-item-action">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </span>
                
                <div class="alert alert-success">
                    <a href="add/add_client" class="list-group-item list-group-item-action">
                        <i class="fas fa-user-plus mr-2"></i>Add New Client
                    </a>
                    <a href="add/add_deposit" class="list-group-item list-group-item-action">
                        <i class="fas fa-money-bill-wave mr-2"></i>Add Deposit
                    </a>
                    <a href="add_transaction.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-exchange-alt mr-2"></i>Add Transaction
                    </a>
                </div>
                
                <div class="alert alert-success">
                    <a href="client/" class="list-group-item list-group-item-action">
                        <i class="fas fa-search mr-2"></i>Check Client Info
                    </a>
                    <a href="client/list" class="list-group-item list-group-item-action">
                        <i class="fas fa-list mr-2"></i>Client List
                    </a>
                    <a href="request/withdrawal_or_loan_request" class="list-group-item list-group-item-action">
                        <i class="fas fa-hand-holding-usd mr-2"></i>Make Request
                    </a>
                    <a href="request/" class="list-group-item list-group-item-action">
                        <i class="fas fa-check-circle mr-2"></i>Complete Request
                    </a>
                </div>
                
                <div class="alert alert-success">
                    <a href="history/loan" class="list-group-item list-group-item-action">
                        <i class="fas fa-history mr-2"></i>Loan History
                    </a>
                    <a href="history/withdrawal" class="list-group-item list-group-item-action">
                        <i class="fas fa-wallet mr-2"></i>Withdrawal History
                    </a>
                </div>
                
                <div class="alert alert-success">
                    <a href="request/loan_request_list.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Loan Requests
                    </a>
                    <a href="request/saving_withdrawal_request_list.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-invoice mr-2"></i>Withdrawal Requests
                    </a>
                </div>
                
                <div class="alert alert-success">
                    <a href="history/saving_deposit" class="list-group-item list-group-item-action">
                        <i class="fas fa-piggy-bank mr-2"></i>Deposit List
                    </a>
                    <a href="history/installment_deposit" class="list-group-item list-group-item-action">
                        <i class="fas fa-calendar-check mr-2"></i>Installment List
                    </a>
                </div>
                
                <div class="alert alert-success">
                    <a href="history/" class="list-group-item list-group-item-action">
                        <i class="fas fa-calendar-day mr-2"></i>Daily History
                    </a>
                    <a href="history/daily_calculation" class="list-group-item list-group-item-action">
                        <i class="fas fa-calculator mr-2"></i>Daily Calculation
                    </a>
                    <a href="setting" class="list-group-item list-group-item-action">
                        <i class="fas fa-cogs mr-2"></i>Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="btn" id="menu-toggle">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <i class="fas fa-user-circle fa-2x text-primary"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <div class="dropdown-header text-center">
                                    <p class="mb-0 text-success font-weight-bold">Welcome <?php echo $_SESSION["username"]; ?></p>
                                    <small class="text-muted">System Administrator</small>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="setting">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                                <a class="dropdown-item" href="logout">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Welcome Alert -->
            <div class="welcome-alert fade-in">
                <marquee scrollamount="3">
                    <span class="font-weight-bold">Welcome <?php echo $_SESSION["username"]; ?> to Dashboard</span> • 
                    <span id="today"></span> • 
                    <span>Date Format: Month - Day - Year</span>
                </marquee>
            </div>

            <!-- Main Content -->
            <div class="container-fluid mt-3">
                <!-- Statistics Row 1 -->
                <div class="row fade-in">
                    <!-- Total Capital -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Total Capital</div>
                                        <div class="stat-card-value">৳ 
                                            <?php 
                                                $sql = "SELECT * FROM information WHERE id = 1";
                                                $sth = $conn->query($sql);
                                                $result=mysqli_fetch_array($sth);
                                                echo number_format($result["capital"]);
                                                $lp = $result['loan_percentage'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                                            <i class="fas fa-coins"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Interest -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Total Interest from Loans</div>
                                        <div class="stat-card-value">৳ 
                                            <?php 
                                                $sql = "SELECT SUM(amount) as amount FROM loan_list WHERE loan_complete =1";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format(($total_capital["amount"]/100)*$lp);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #f39c12 0%, #d68910 100%);">
                                            <i class="fas fa-percentage"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Loan -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Active Loans</div>
                                        <div class="stat-card-value">৳ 
                                            <?php 
                                                $sql = "SELECT SUM(amount) as amount FROM loan_list where active = 1";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format($total_capital["amount"]);
                                            ?>
                                        </div>
                                        <a href="history/loan" class="stat-card-detail">
                                            <?php 
                                                $sql = "SELECT COUNT(*) as count FROM loan_list where active = 1";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo $total_capital["count"] . " active loans • View Details";
                                            ?>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Pending Requests</div>
                                        <div class="stat-card-value">
                                            <span style="color: #e74c3c;">
                                                <?php 
                                                    $sql = "SELECT COUNT(*) as k FROM loan_list WHERE req_status = 1";
                                                    $sth = $conn->query($sql);
                                                    $total_capital=mysqli_fetch_array($sth);
                                                    echo $total_capital["k"];
                                                ?>
                                            </span> 
                                            <span style="color: #27ae60;"> | 
                                                <?php 
                                                    $sql = "SELECT COUNT(*) as k FROM withdrawal_list WHERE req_status = 1";
                                                    $sth = $conn->query($sql);
                                                    $total_capital=mysqli_fetch_array($sth);
                                                    echo $total_capital["k"];
                                                ?>
                                            </span>
                                        </div>
                                        <a href="request/" class="stat-card-detail">
                                            Loan | Withdrawal • Process Now
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #27ae60 0%, #229954 100%);">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Row 2 -->
                <div class="row fade-in">
                    <!-- Total Clients -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Total Clients</div>
                                        <div class="stat-card-value">
                                            <?php 
                                                $sql = "SELECT COUNT(*) as k FROM client";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format($total_capital["k"]);
                                            ?>
                                        </div>
                                        <a href="client/list" class="stat-card-detail">View Client List →</a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Saving Deposit -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Total Saving Deposit</div>
                                        <div class="stat-card-value">৳ 
                                            <?php 
                                                $sql = "SELECT SUM(amount) as amount FROM saving_deposit";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format($total_capital["amount"]);
                                            ?>
                                        </div>
                                        <a href="history/saving_deposit" class="stat-card-detail">
                                            <?php 
                                                $sql = "SELECT COUNT(*) as k FROM saving_deposit";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo $total_capital["k"] . " deposits • View Details";
                                            ?>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #2980b9 0%, #1f6396 100%);">
                                            <i class="fas fa-store"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Installment Collection -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Installment Collection</div>
                                        <div class="stat-card-value">৳ 
                                            <?php 
                                                $sql = "SELECT SUM(amount) as amount FROM installment_deposit";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format($total_capital["amount"]);
                                            ?>
                                        </div>
                                        <div class="small text-danger font-weight-bold">
                                            Due: ৳ 
                                            <?php 
                                                $sql = "SELECT SUM(due) as due FROM loan_list WHERE loan_complete = 0 AND req_status = 0";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format($total_capital["due"]);
                                            ?>
                                        </div>
                                        <a href="history/installment_deposit" class="stat-card-detail">View Details →</a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #48c9b0 0%, #17a589 100%);">
                                            <i class="fas fa-piggy-bank"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Savings Withdrawal -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="stat-card-title">Total Withdrawals</div>
                                        <div class="stat-card-value">৳ 
                                            <?php 
                                                $sql = "SELECT SUM(amount) as amount FROM withdrawal_list where req_status = 0";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo number_format($total_capital["amount"]);
                                            ?>
                                        </div>
                                        <a href="history/withdrawal" class="stat-card-detail">
                                            <?php 
                                                $sql = "SELECT COUNT(*) as k FROM withdrawal_list where req_status = 0";
                                                $sth = $conn->query($sql);
                                                $total_capital=mysqli_fetch_array($sth);
                                                echo ($total_capital["k"]-1) . " withdrawals • View Details";
                                            ?>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="stat-card-icon" style="background: linear-gradient(135deg, #5499c7 0%, #2980b9 100%);">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Check Forms -->
                <div class="row mt-4 fade-in">
                    <div class="col-12 mb-3">
                        <h4 class="font-weight-bold text-dark">
                            <i class="fas fa-search mr-2"></i>Quick Check
                        </h4>
                        <p class="text-muted">Quickly check client status, loan details, and transaction history</p>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="check-card" style="border-top-color: #3498db;">
                            <div class="check-card-header">
                                <i class="fas fa-user-check mr-2"></i>Check Client Status
                            </div>
                            <div class="check-card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="acc_no" placeholder="Account Number" required>
                                    </div>
                                    <button type="submit" name="check_client" class="btn btn-primary btn-block">
                                        <i class="fas fa-search mr-2"></i>Check Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="check-card" style="border-top-color: #f39c12;">
                            <div class="check-card-header">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>Check Loan Status
                            </div>
                            <div class="check-card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="loan_no" placeholder="Loan Number" required>
                                    </div>
                                    <button type="submit" name="check_loan" class="btn btn-primary btn-block">
                                        <i class="fas fa-search mr-2"></i>Check Loan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="check-card" style="border-top-color: #27ae60;">
                            <div class="check-card-header">
                                <i class="fas fa-piggy-bank mr-2"></i>Check Savings Deposit
                            </div>
                            <div class="check-card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="acc_no" placeholder="Account Number" required>
                                    </div>
                                    <button type="submit" name="c_s_d" class="btn btn-primary btn-block">
                                        <i class="fas fa-search mr-2"></i>Check Deposits
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="check-card" style="border-top-color: #e74c3c;">
                            <div class="check-card-header">
                                <i class="fas fa-calendar-check mr-2"></i>Check Installments
                            </div>
                            <div class="check-card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="loan_no" placeholder="Loan Number" required>
                                    </div>
                                    <button type="submit" name="c_i_d" class="btn btn-primary btn-block">
                                        <i class="fas fa-search mr-2"></i>Check Installments
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/fontawesome.js"></script>
    <script src="../js/sweetalert.js"></script>
    <script src="../js/main.js"></script>
    <script>
        window.onload = function() {
            // Update time
            var d = new Date();          
            var options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true 
            };
            var n = d.toLocaleString('en-US', options);
            document.getElementById("today").innerHTML = n;

            // Toggle sidebar
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            // SweetAlert notifications
            var url = window.location.toString();
            if (url.includes("index.php?login") && !url.includes("#")) {
                var name = url.split("=")[1].substring(0, 11);
                swal({
                    title: "Welcome!",
                    text: name + ", you have successfully logged in.",
                    icon: "success",
                    button: "Continue",
                    timer: 3000
                });
            }

            if (url.includes("loan_no_not_found")) {
                swal("Loan Number Not Found", "Please check the loan number and try again.", "error");
            }
            
            if (url.includes("index.php?acc_no_not_found")) {
                swal("Account Number Not Found", "Please check the account number and try again.", "error");
            }
        }
    </script>
</body>
</html>