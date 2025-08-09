<?php
session_start(); // Start session

if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: homepage.php");
    exit();
}
$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_errno($con));

// Fetch user data from the database
$username = $_SESSION['username'];
$query = mysqli_query($con, "SELECT * FROM register WHERE username='$username'") or die(mysqli_error($con));
$userData = mysqli_fetch_array($query);

if (!$userData) {
    die("User not found!"); // Handle the case when user doesn't exist
}

// Extract user_id from the fetched data
$user_id = $userData['user_id']; // Assuming 'user_id' exists in 'register' table

// Fetch ongoing orders
$orders_query = mysqli_query($con, "SELECT * FROM `order` WHERE status NOT IN ('Completed', 'Pick-Up')") or die(mysqli_error($con));

// Update order status
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    mysqli_query($con, "UPDATE `order` SET status='$new_status' WHERE order_id='$order_id'") or die(mysqli_error($con));
    echo "<script>alert('Order status updated!'); window.location.href='';</script>";
}
?>
<!DOCTYPE html><!-- This site was created in Webflow. https://webflow.com -->
<!-- Last Published: Thu Oct 03 2024 11:20:43 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="wealth-bento-webflow-template.webflow.io" data-wf-page="66e5617251244bd7bc7033f7" data-wf-site="66e3df8d47eb3991ca9dbef7" lang="en">
    <head><meta charset="utf-8"/>
        <title>Tailor Track System</title>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." name="description"/>
        <meta content="Wealth Bento - Webflow HTML website template" property="og:title"/><meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." property="og:description"/>
        <meta content="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66f282e6ba83a3e79649c300_SEO.png" property="og:image"/>
        <meta content="Wealth Bento - Webflow HTML website template" property="twitter:title"/>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." property="twitter:description"/>
        <meta content="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66f282e6ba83a3e79649c300_SEO.png" property="twitter:image"/>
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
                        <a href="logout.php" aria-current="page" class="nav-link w-nav-link w--current">Logout</a>
                        <a href="logout.php" aria-current="page" class="nav-link move-down hide-on-tab w-nav-link w--current">Logout</a>
                    </div>
                </nav>
                <div class="menu-button w-nav-button">
                    <div class="burger-icon w-icon-nav-menu"></div>
                </div>
            </div>
        </div>
        <section class="section">
                    <div class="w-layout-blockcontainer container w-container">
                        <div class="space-page-top">

                        </div>
                        <div class="about-flex">
                            <div class="services-block slide-from-left-animation">
                                <div class="subheading-flex">
                                </div>
                            </div>
                    </div>
                </section>
                
                    <section class="section">
                        <div class="w-layout-blockcontainer container w-container">
                            <div class="about-flex"><div class="services-block slide-from-left-animation">
                                <div class="subheading-flex">
                                </div>
                                <h1>Tailor</h1>
                            </div>
                        </div>
                        <div class="space-4rem">
                        </div>
                        

                        <div class="faq-wrapper open" style="display: block; opacity: 1 !important; gap: 20px; width: 100%; padding: 0;">
                            <div class="faq-dropdown">
                                
                                    <div class="faq-flex">
                                        <h4 class="faq-question">On-Going order</h4>
                                        
                                    </div>
                                    
                                    <div class="dropdown-answer" style="opacity: 1 !important; height: auto; transform: translate3d(0, 0, 0) scale3d(1, 1, 1);">
                                     
                                        <div class="w-layout-blockcontainer w-container" style="width: 100%; padding: 0;">
                                        <?php if (mysqli_num_rows($orders_query) > 0): ?>
                                        <div style="margin-top: 20px;">
                                            <table style="width: 100%; table-layout: auto; border-collapse: collapse; font-family: 'Inter', sans-serif;">
                                                <thead>
                                                    <tr style="background-color: #c69b6b; color: white; text-align: left;">
                                                        <th style="padding: 12px;">Order ID</th>
                                                        <th style="padding: 12px;">Service Type</th>
                                                        <th style="padding: 12px;">Order Type</th>
                                                        <th style="padding: 12px;">Size</th>
                                                        <th style="padding: 12px;">Order Date</th>
                                                        <th style="padding: 12px;">Due Date</th>
                                                        <th style="padding: 12px;">Status</th>
                                                        <th style="padding: 12px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($order = mysqli_fetch_assoc($orders_query)): ?>
                                                    <tr style="border-bottom: 1px solid #f1d9b4ff;">
                                                        <td style="padding: 12px;"><?php echo $order['order_id']; ?></td>
                                                        <td style="padding: 12px;"><?php echo $order['service_type']; ?></td>
                                                        <td style="padding: 12px;"><?php echo $order['order_type']; ?></td>
                                                        <td style="padding: 12px;"><?php echo $order['size']; ?></td>
                                                        <td style="padding: 12px;"><?php echo $order['order_date']; ?></td>
                                                        <td style="padding: 12px;"><?php echo $order['due_date']; ?></td>
                                                        <td style="padding: 12px;"><?php echo $order['status']; ?></td>
                                                        <td style="padding: 12px;">
                                                            <form method="POST" action="" style="display: flex; gap: 10px; align-items: center;">
                                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                                <select name="new_status" style="padding: 6px; border-radius: 4px; border: 1px solid #ccc;">
                                                                    <option value="Processing" <?php if ($order['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                                                                    <option value="In Progress" <?php if ($order['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                                                                    <option value="Completed" <?php if ($order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                                                </select>
                                                                <button type="submit" name="update_status" style="background-color: #c69b6b; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php else: ?>
                                            <p style="padding-top: 1rem;">No ongoing orders found.</p>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                    <div class="space-1rem">
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="space-7rem">

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
            <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=66e3df8d47eb3991ca9dbef7" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">

            </script>
            <script src="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/js/webflow.9633dd252.js" type="text/javascript">

            </script>
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