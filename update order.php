<?php
session_start();

// Connect to DB
$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_error());

// Handle form submission to add new order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
    $service_type = mysqli_real_escape_string($con, $_POST['service_type']);
    $order_type = mysqli_real_escape_string($con, $_POST['order_type']);
    // Determine which size was submitted
    switch ($order_type) {
        case 'Muslimah Clothes':
            $size = mysqli_real_escape_string($con, $_POST['size_muslimah']);
            break;
        case 'Kids Clothes':
            $size = mysqli_real_escape_string($con, $_POST['size_kids']);
            break;
        case 'Adult Long Sleeves':
            $size = mysqli_real_escape_string($con, $_POST['size_long']);
            break;
        case 'Adult Short Sleeves':
            $size = mysqli_real_escape_string($con, $_POST['size_short']);
            break;
        default:
            $size = '';
            break;
    }     
    $order_date = $_POST['order_date'];
    $due_date = $_POST['due_date'];
    $quantity = $_POST['quantity'];
    $notes = mysqli_real_escape_string($con, $_POST['notes']);
    $user_id = $_SESSION['user_id'];  // Assuming the user is logged in

    $insert = "INSERT INTO orders (customer_name, order_type, size, order_date, due_date, quantity, notes, user_id)
               VALUES ('$customer_name', '$order_type', '$size', '$order_date', '$due_date', '$quantity', '$notes', '$user_id')";
    
    if (mysqli_query($con, $insert)) {
        echo "<script>alert('Order submitted successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch orders with optional search by order ID
$search_order_id = isset($_GET['order_id']) ? mysqli_real_escape_string($con, $_GET['order_id']) : '';
$query = "SELECT * FROM `order` WHERE order_id LIKE '%$search_order_id%'";

// Fetch all orders
$orders_query = mysqli_query($con, $query) or die(mysqli_error($con));

// Handle delete request
if (isset($_GET['delete'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete']);
    $delete_query = "DELETE FROM `order` WHERE order_id = '$delete_id'";
    if (mysqli_query($con, $delete_query)) {
        echo "<script>alert('Order deleted successfully'); window.location.href='".$_SERVER['PHP_SELF']."';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Tailor Track System</title>
    <link href="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/css/wealth-bento-webflow-template.webflow.2c90d30fb.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({ google: { families: ["Inter:100,300,regular,500,600,700,100italic,300italic,italic,500italic,600italic,700italic"] } });</script>
    <style>
        .container {
            margin-top: 50px;
            margin-left:40px;
            padding-right:80px;
        }
        .order-list h3 {
            margin-top: 2px; /* Adjust the value as needed to push the title further down */
        }
        .order-list {
            margin-top: 100px;
            padding: 50px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .order-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-list table th, .order-list table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .order-list table th {
            background-color: #f5f5f5;
        }
        .edit-btn {
            background-color: #5fa2dd;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .edit-btn:hover {
            background-color: #4d8ec2;
        }
        .delete-btn {
            background-color: #5fa2dd;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-btn:hover {
            background-color: #4d8ec2;
        }
        .search-bar button {
            margin-left: 10px;
            margin-bottom: 10px;
        }
        .search-bar {
            margin-top: 30px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-top:20px;
        }
        .search-bar input {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            width: 80%;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
            margin-bottom: 10px;;
        }
        .search-bar input:focus {
            border-color: #5fa2dd;
            outline: none;
        }
        .btn-submit {
            background-color: #5fa2dd;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .btn-submit:hover {
            background-color: #4d8ec2;
        }

        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 14px;
            font-size: 20px;
            border-radius: 50%;
            text-align: center;
            text-decoration: none;
            z-index: 9999;
            opacity: 0.7;
            transition: opacity 0.3s;
            }

            #backToTop:hover {
            opacity: 1;
            }
    </style>
</head>
<body>

<!-- Header -->
<div data-animation="default" class="navbar w-nav" data-easing2="ease" data-easing="ease" data-collapse="medium" data-w-id="06ab6c64-468c-b44e-1b8c-856deb96ba7f" role="banner" data-no-scroll="1" data-duration="400" data-doc-height="1">
            <a href="/" aria-current="page" class="logo-link-wrapper w-nav-brand w--current">
                <img src="logo.jpg" alt="Logo" class="logo" style="width: auto; height: 100px; max-height: none;">
            </a>
        <div class="nav-container w-container">
            <nav role="navigation" class="nav-menu w-nav-menu">
                <div class="nav-link-wrapper">
                    <a href="admin.php" class="nav-link w-nav-link">Home</a>
                    <a href="admin.php" class="nav-link move-down hide-on-tab w-nav-link">Home</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="logout.php" class="nav-link w-nav-link">Logout</a>
                    <a href="logout.php" class="nav-link move-down hide-on-tab w-nav-link">Logout</a>
                </div>
            </nav>
            <div class="menu-button w-nav-button">
                <div class="burger-icon w-icon-nav-menu"></div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">

            <!-- List of orders -->
            <div class="order-list">
                <h3> Order List</h3>
                <!-- Search bar -->
                <div class="search-bar">
                    <input type="text" id="search_input" name="order_id" placeholder="Search Order by ID" value="<?php echo $search_order_id; ?>" oninput="searchOrder()" />
                    <button type="button" id="clear_btn" onclick="clearSearch()">&#10005;</button> <!-- 'X' symbol -->
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Service Type</th>
                            <th>Order Type</th>
                            <th>Size</th>
                            <th>Order Date</th>
                            <th>Due Date</th>
                            <th>Quantity</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = mysqli_fetch_assoc($orders_query)) { ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['service_type']; ?></td>
                                <td><?php echo $order['order_type']; ?></td>
                                <td><?php echo $order['size']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['due_date']; ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                                <td><?php echo $order['notes']; ?></td>
                                <td style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>" class="edit-btn">Edit</a>
                                    <a href="?delete=<?php echo $order['order_id']; ?>" class="delete-btn" style="background-color: #e74c3c;" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>



<!-- Footer  -->
<section class="section background-black">
        <div class="w-layout-blockcontainer container padding-4-5rem w-container">
            <div class="space-2rem">
            </div>
            <div data-w-id="fa36639f-bc34-8f1a-4024-d088998077f8" class="footer-top">
                <div class="footer-block">
                    <a href="/" class="footer-logo-link-wrapper w-nav-brand">
                        <img width="Auto" height="Auto" alt="Logo" src="logo.jpg" loading="eager" srcset="logo.jpg 500w, logo.jpg 800w, logo.jpg 1011w" sizes="(max-width: 767px) 98vw, (max-width: 991px) 95vw, 940px" class="footer-logo"/>
                    </a>
                    <div class="socials-wrapper">
                        <a href="https://www.facebook.com/smartgentztailoring/?locale=ms_MY" target="_blank" class="w-inline-block">
                            <img width="Auto" height="Auto" alt="" src="facebook.png" loading="eager" srcset="facebook.png 500w, facebook.png 512w" sizes="(max-width: 512px) 100vw, 512px" class="social-icon smaller"/>
                        </a>
                        <a href="https://www.wasap.my/60139204301" target="_blank" class="w-inline-block">
                            <img width="Auto" height="Auto" alt="" src="whatsapp.png" loading="eager" srcset="whatsapp.png 500w, whatsapp.png 512w" sizes="(max-width: 512px) 100vw, 512px" class="social-icon smaller"/>
                        </a>
                        <a href="https://www.instagram.com/smartgents_majutrading?igsh=ZHUxd2tsdzZ5OTY5" target="_blank" class="w-inline-block">
                            <img width="Auto" height="Auto" alt="" src="instagram.png" loading="eager" srcset="instagram.png 500w, instagram.png 512w" sizes="(max-width: 512px) 100vw, 512px" class="social-icon smaller"/>
                        </a>
                        <a href="https://www.tiktok.com/@smartmajutrading889?_t=ZS-8yQrKYlgst8&_r=1" target="_blank" class="w-inline-block">
                            <img width="Auto" height="Auto" alt="" src="tiktok.png" loading="eager" srcset="tiktok.png 500w, tiktok.png 512w" sizes="(max-width: 512px) 100vw, 512px" class="social-icon smaller"/></a>
                        </div>
                        <p class="max-width-17vw font-white">Sewing Services & Supply of Fabrics and Clothing.</p>
                    </div>
                    <div class="footer-right-flex">
                        <div class="footer-wrapper">
                            <h5 class="font-white">Main</h5>
                            <div class="footer-link-wrapper">
                                <a href="admin.php" class="footer-link">Home</a>
                                <a href="admin.php" class="footer-link move-down">Home</a>
                            </div>
                            <div class="footer-link-wrapper">
                                <a href="logout.php" class="footer-link">Logout</a>
                                <a href="logout.php" class="footer-link move-down">Logout</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div data-w-id="fa36639f-bc34-8f1a-4024-d0889980784b" class="footer-line">

                    </div>
                    <div data-w-id="fa36639f-bc34-8f1a-4024-d0889980784c" class="footer-bottom">
                        <p class="font-white">© 2025 Smart Maju Trading. All Rights Reserved. </p>
                        <div class="footer-flex">
                            <div class="footer-flex-bottom">
                                <p class="font-white">Powered By </p>
                                <a href="https://webflow.com/" target="_blank" class="w-inline-block">
                                    <p class="footer-bottom-text">Webflow</p>
                                </a>
                            </div>
                            <div class="footer-flex-bottom">
                                <p class="font-white">Built By  </p>
                                <a href="https://webflow.com/templates/designers/rick-mummery" target="_blank" class="w-inline-block">
                                    <p class="footer-bottom-text">Maris, Oya, Suri Atul</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=66e3df8d47eb3991ca9dbef7" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <script src="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/js/webflow.9633dd252.js" type="text/javascript"></script>
            <a href="#" id="backToTop" title="Back to top">&#8679;</a>
                <script>
                // Smooth scroll to top
                document.getElementById("backToTop").addEventListener("click", function (e) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: "smooth" });
                });
                </script>

                <script>
                    // Smooth scroll to top
                    document.getElementById("backToTop").addEventListener("click", function (e) {
                        e.preventDefault();
                        window.scrollTo({ top: 0, behavior: "smooth" });
                    });
                </script>
                <script>
                // Function to trigger search as user types
                function searchOrder() {
                    var search_value = document.getElementById('search_input').value;
                    // Redirect to search with the entered value
                    window.location.href = '?order_id=' + search_value;
                }

                // Function to clear the search input field
                function clearSearch() {
                    document.getElementById('search_input').value = '';  // Clear the input
                    window.location.href = '?order_id=';  // Clear the search query
                }
                </script>
                </script>

</body>
</html>
