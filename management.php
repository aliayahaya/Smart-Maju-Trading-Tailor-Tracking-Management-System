<?php
session_start(); // Start session

$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_errno($con));

// Query to get statistics for staff, total orders, total sales, and top order (service_type)
$staffCountQuery = "SELECT 
                        (SELECT COUNT(*) FROM admin) + 
                        (SELECT COUNT(*) FROM tailor) AS staff_count";
$orderCountQuery = "SELECT COUNT(*) AS order_count FROM `order`"; // Example query for total orders
$totalSalesQuery = "SELECT SUM(amount_paid) AS total_sales FROM `order`";
$topOrderQuery = "SELECT service_type, COUNT(*) AS count FROM `order` GROUP BY service_type ORDER BY count DESC LIMIT 1"; // Query for top service_type

// Execute the queries
$staffCountResult = mysqli_query($con, $staffCountQuery);
$orderCountResult = mysqli_query($con, $orderCountQuery);
$totalSalesResult = mysqli_query($con, $totalSalesQuery);
$topOrderResult = mysqli_query($con, $topOrderQuery);

// Fetch the results
$staffCount = mysqli_fetch_assoc($staffCountResult)['staff_count'];
$orderCount = mysqli_fetch_assoc($orderCountResult)['order_count'];
$totalSales = mysqli_fetch_assoc($totalSalesResult)['total_sales'];
$topOrder = mysqli_fetch_assoc($topOrderResult)['service_type'];


?>
<!DOCTYPE html>
<!-- This site was created in Webflow. https://webflow.com -->
 <!-- Last Published: Thu Oct 03 2024 11:20:43 GMT+0000 (Coordinated Universal Time) -->
  <html data-wf-domain="wealth-bento-webflow-template.webflow.io" data-wf-page="66e59cc0aec43ebddff8ff31" data-wf-site="66e3df8d47eb3991ca9dbef7" lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Tailor Track System</title>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." name="description"/>
        <meta content="Wealth Bento - Webflow HTML website template" property="og:title"/>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." property="og:description"/>
        <meta content="Wealth Bento - Webflow HTML website template" property="twitter:title"/>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." property="twitter:description"/>
        <meta property="og:type" content="website"/>
        <meta content="summary_large_image" name="twitter:card"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Webflow" name="generator"/>
        <link href="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/css/wealth-bento-webflow-template.webflow.2c90d30fb.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous"/>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
        <script type="text/javascript">WebFont.load({  google: {    families: ["Inter:100,300,regular,500,600,700,100italic,300italic,italic,500italic,600italic,700italic"]  }});</script>
        <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
        <link href="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66f277be610869faeab12d72_Favicon.png" rel="shortcut icon" type="image/x-icon"/>
        <link href="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66f2778d6d3e24b36c798724_Webclip.png" rel="apple-touch-icon"/>
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

            
        .footer-logo { max-width: 100%; }
        img { max-width: 100%; height: auto; }
        @media only screen and (max-width: 767px) {
            .w-layout-blockcontainer { flex-direction: column; }
            .utilities-flex { flex-direction: column; }
        }
        /* Basic container styling */
        .container {
        max-width: 100%; /* Ensure the container stretches fully */
        padding-left: 15px; /* Add some padding to the left */
        padding-right: 15px; /* Add some padding to the right */
        }

        /* Row with custom spacing between columns */
        .row {
        display: flex;
        flex-wrap: wrap; /* Allow columns to wrap in smaller screens */
        gap: 20px; /* Add space between columns */
        }

        /* Styling for each column */
        .col-12 {
        width: 100%; /* Full width for small screens */
        padding: 15px; /* Add padding inside each column */
        box-sizing: border-box; /* Ensure padding is considered inside the column size */
        }

        .col-md-6 {
        width: 50%; /* 50% width for medium screens and above */
        }

        /* Custom padding for each column */
        .p-3 {
        padding: 20px; /* Add custom padding */
        background-color: #f4f4f4; /* Light background color */
        border: 1px solid #ddd; /* Light border */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
        text-align: center; /* Center the text inside the column */
        }

        /* For mobile devices (screen width 0 to 576px) */
        @media (max-width: 576px) {
        .col-12 {
            width: 100%; /* Ensure full width for mobile */
        }
        }

        /* For tablets and up (screen width 576px and up) */
        @media (min-width: 576px) {
        .col-md-6 {
            width: 50%; /* Two columns in each row for medium screens */
        }
        }

        /* For larger screens (screen width 768px and up) */
        @media (min-width: 768px) {
        .col-md-6 {
            width: 50%; /* Maintain 50% width per column */
        }
        }

        
        </style>
    </head>
    <body>
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
                    <div class="burger-icon w-icon-nav-menu">

                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="w-layout-blockcontainer container overflow w-container">
                <div class="space-page-top">

                </div>
                <div class="space-2rem">

                </div>
                <div class="utilities-flex">
                    <div class="utilities-side-bar">
                        <a href="management staff.php" class="utilities-flex-title w-inline-block">
                            <img src="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66e3e0385d5287c0e727e2ef_Vectors-Wrapper.svg" loading="lazy" width="Auto" height="Auto" alt="" class="utilities-icon"/>
                            <h4 class="no-wrap">Staff</h4>
                        </a>
                        <a href="management order.php" aria-current="page" class="utilities-flex-title w-inline-block w--current">
                            <img src="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66e3e0395d5287c0e727e330_Vectors-Wrapper.svg" loading="lazy" width="Auto" height="Auto" alt="" class="utilities-icon"/>
                            <h4 class="no-wrap">Order</h4>
                        </a>
                    </div>
                    <div class="utilities-wrapper slide-from-right-animation">
                        <div class="utilities-title">
                            <h2>Management</h2>
                            <p>Oversee business performance, analyze sales data and generate insightful reports for better decision-making.</p>
                        </div>
                        <div class="line-spacer">
                            <div class="space-4rem">

                            </div>
                            <div class="utilities-line-spacer">

                            </div>
                            <div class="space-4rem">

                            </div>
                            <div class="utilities-title">
                            <h4>Overview</h4>
                            <p>Statistics Dashboard</p>
                            <div class="container overflow-hidden text-center">
                            <div class="row gy-5">
                                <!-- First card: Staff count -->
                                <div class="col-12 col-md-6">
                                    <div class="p-3 bg-dark text-light">
                                        <h5>Number of Staff</h5>
                                        <p><?php echo $staffCount; ?></p>
                                    </div>
                                </div>

                                <!-- Second card: Total orders -->
                                <div class="col-12 col-md-6">
                                    <div class="p-3 bg-dark text-light">
                                        <h5>Total Orders</h5>
                                        <p><?php echo $orderCount; ?></p>
                                    </div>
                                </div>

                                <!-- Third card: Total sales -->
                                <div class="col-12 col-md-6">
                                    <div class="p-3 bg-dark text-light">
                                        <h5>Total Sales</h5>
                                        <p>RM <?php echo number_format($totalSales, 2); ?></p> <!-- Format as currency -->
                                    </div>
                                </div>

                                <!-- Fourth card: Top order (service_type) -->
                                <div class="col-12 col-md-6">
                                    <div class="p-3 bg-dark text-light">
                                        <h5>Top Order (Service Type)</h5>
                                        <p><?php echo $topOrder; ?></p>
                                    </div>
                                    <div class="space-4rem">

                                    </div>
                                </div>
                            </div>
                        </div>



        </section>
    
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