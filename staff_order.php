<?php
session_start();

// Connect to DB
$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_error());

// Fetch user data from the database
$username = $_SESSION['username'];
$query = mysqli_query($con, "SELECT * FROM register WHERE username='$username'") or die(mysqli_error($con));
$userData = mysqli_fetch_array($query);


// Fetch tailor data
$tailor_query = mysqli_query($con, "SELECT * FROM tailor") or die(mysqli_error($con));
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. https://webflow.com -->
<!-- Last Published: Tue Jul 15 2025 18:20:44 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="allya-marissas-fresh-site.webflow.io" data-wf-page="685c1e8fae4696d62caa7bc9" data-wf-site="685c1e8eae4696d62caa7b3f" data-wf-status="1" lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Tailor Track System</title>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." name="description"/>
        <meta content="Wealth Bento - Webflow HTML website template" property="og:title"/>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." property="og:description"/>
        <meta content="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66f282e6ba83a3e79649c300_SEO.png" property="og:image"/>
        <meta content="Wealth Bento - Webflow HTML website template" property="twitter:title"/>
        <meta content="Wealth Bento is a dynamic Webflow template crafted for SaaS tech companies aiming to make an impact. With an intuitive CMS and robust customization features." property="twitter:description"/>
        <meta content="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/66f282e6ba83a3e79649c300_SEO.png" property="twitter:image"/>
        <meta property="og:type" content="website"/>
        <meta content="summary_large_image" name="twitter:card"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Webflow" name="generator"/>
        <link href="staff.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous"/>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript">
        </script>
        <script type="text/javascript">WebFont.load({  google: {    families: ["Inter:100,300,regular,500,600,700,100italic,300italic,italic,500italic,600italic,700italic"]  }});</script>
        <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);
        </script>
        <link href="https://cdn.prod.website-files.com/685c1e8eae4696d62caa7b3f/685c1e8fae4696d62caa7d9c_Favicon.png" rel="shortcut icon" type="image/x-icon"/>
        <link href="https://cdn.prod.website-files.com/685c1e8eae4696d62caa7b3f/685c1e8fae4696d62caa7d9b_Webclip.png" rel="apple-touch-icon"/>
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
            .container h3 {
                margin-top: 50px;
                margin-bottom: 20px;
                padding-left: 5px;
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
                background-color: #f5f5f5ff;
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
        <div class="container">
        
        <!-- List of Tailor -->
            <div class="order-list">
                <h3> View Tailor</h3>
                <!-- Search bar -->
                <table>
                    <thead>
                        <tr>
                            <th>Tailor ID</th>
                            <th>Tailor Name</th>
                            <th>Tailor Phone</th>
                            <th>Tailor Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($query = mysqli_fetch_assoc($tailor_query)) { ?>
                            <tr>
                                <td><?php echo $query['tailor_id']; ?></td>
                                <td><?php echo $query['tailor_name']; ?></td>
                                <td><?php echo $query['tailor_phone']; ?></td>
                                <td><?php echo $query['tailor_email']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    </section>
        <section class="section">
            <div class="w-layout-blockcontainer container padding-9rem w-container">
             
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
                                    <p class="footer-bottom-text"> Webflow</p>
                                </a>
                            </div>
                            <div class="footer-flex-bottom">
                                <p class="font-white">Built By  </p>
                                <a href="https://webflow.com/templates/designers/rick-mummery" target="_blank" class="w-inline-block">
                                    <p class="footer-bottom-text"> Maris, Oya, Suri Atul</p>
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