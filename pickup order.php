<?php
session_start();

// Connect to DB
$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_error());

// Fetch completed orders
$orders_query = mysqli_query($con, "SELECT * FROM `order` WHERE status = 'Completed'") or die(mysqli_error($con));

// Handle order status update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $amount_paid = $_POST['amount_paid'];
    $status = 'Pick-Up';

    // Update the status to 'Pick-Up' and the amount paid
    $update_query = "UPDATE `order` SET status = '$status', amount_paid = '$amount_paid' WHERE order_id = '$order_id'";
    if (mysqli_query($con, $update_query)) {
        $_SESSION['flash_message'] = 'Order updated to Pick-Up successfully.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Tailor Track System</title>
    <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact." name="description"/>
    <meta content="Tailor Track System" property="og:title"/>
    <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact." property="og:description"/>
    <meta property="og:type" content="website"/>
    <meta content="summary_large_image" name="twitter:card"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link href="staff.css" rel="stylesheet" type="text/css"/>
    <style>
        .w-webflow-badge {
            display: none !important;
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

        .container {
            margin-top: 50px;
            margin-left:40px;
            padding-right:80px;
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

        .form-input {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }

        .form-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
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
        </div>
    </div>

    <!-- Order List Section -->
    <section class="section">
        <div class="container">
            <div class="order-list">
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <script>
                        alert('<?php echo $_SESSION['flash_message']; ?>');
                    </script>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>
                <h3>Order List (Awaiting for Pick-Up)</h3>
                <br><br>
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
                            <th>Amount Paid</th>
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
                                <td><?php echo $order['amount_paid']; ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                        <input type="number" name="amount_paid" class="form-input" placeholder="Amount Paid" required>
                                        <button type="submit" name="update_status" class="form-button">Update to Pick-Up</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
</body>
</html>
