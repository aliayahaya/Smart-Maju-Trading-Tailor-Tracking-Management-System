<?php
session_start();

// Connect to DB
$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_error());


// Handle form submission
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

    $insert = "INSERT INTO `order` (service_type, order_type, size, order_date, due_date, quantity, notes)
               VALUES ('$service_type', '$order_type', '$size', '$order_date', '$due_date', '$quantity', '$notes')";
    
    if (mysqli_query($con, $insert)) {
        echo "<script>alert('Order submitted successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
    // Fetch ongoing orders
    $orders_query = mysqli_query($con, "SELECT * FROM `order` WHERE status != 'Completed'") or die(mysqli_error($con));

}
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. https://webflow.com --><!-- Last Published: Thu Oct 03 2024 11:20:43 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="wealth-bento-webflow-template.webflow.io" data-wf-page="66e5a1f2469b044dd17b05af" data-wf-site="66e3df8d47eb3991ca9dbef7" lang="en">
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
                .container {
                margin-top: 150px;
                margin-left:40px;
                padding-right:80px;
            }
            /* Form styling */
            .form-container {
                padding: 30px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 30px;
            }
            .form-container label {
                display: block;
                margin: 30px 0 0px;
            }
            .form-container input, .form-container select, .form-container textarea {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 2px solid #ddd;
                border-radius: 4px;
                font-size: 1rem;
            }

            .form-container textarea {
                resize: vertical;
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
                <div class="space-7rem">
                        </div>
            </div>
        <div class="container">
           <div class="form-container">
            <h3>Add New Order</h3>
            <form action="add order.php" method="POST">
                <label>Service Type:</label><br>
            <select name="service_type" required>
                <option value="">-- Select Type --</option>
                <option value="Embroidery Services">Embroidery Services</option>
                <option value="Formal & Casual Wear Customization">Formal & Casual Wear Customization</option>
                <option value="Custom Garment Making">Custom Garment Making</option>
                <option value="Alterations & Repairs">Alterations & Repairs</option>
                <option value="Fabric Sourcing">Fabric Sourcing</option>
            </select>

            <label>Order Type:</label><br>
            <select name="order_type" id="order_type" required onchange="showSizeOptions()">
                <option value="">-- Select Type --</option>
                <option value="Muslimah Clothes">Muslimah Clothes</option>
                <option value="Kids Clothes">Kids Clothes</option>
                <option value="Adult Long Sleeves">Adult Long Sleeves</option>
                <option value="Adult Short Sleeves">Adult Short Sleeves</option>
                
            </select>

            <!-- Size options for Muslimah -->
            <div id="size_muslimah" class="size-chart" style="display: none;">
                <label>Size (Muslimah Clothes):</label><br>
                <select name="size_muslimah">
                    <option value="">-- Select Size --</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XL">2XL</option>
                    <option value="XL">3XL</option>
                    <option value="XL">4XL</option>
                </select>
            </div>

            <!-- Size options for Kids -->
            <div id="size_kids" class="size-chart" style="display: none;">
                <label>Size (Kids Clothes):</label><br>
                <select name="size_kids">
                    <option value="">-- Select Size --</option>
                    <option value="1-2">1-2 y/o</option>
                    <option value="3-4">3-4 y/o</option>
                    <option value="5-6">5-6 y/o</option>
                    <option value="7-8">7-8 y/o</option>
                    <option value="9-10">9-10 y/o</option>
                    <option value="11-12">11-12 y/o</option>
                    <option value="13-14">13-14 y/o</option>
                    <option value="15-16">15-16 y/o</option>
                </select>
            </div>

            <!-- Size options for Adult Long Sleeves -->
                <div id="size_long" class="size-chart" style="display: none;">
                    <label>Size (Adult Long Sleeves):</label><br>
                    <select name="size_long">
                        <option value="">-- Select Size --</option>
                        <option value="S">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="2XL">2XL</option>
                        <option value="3XL">3XL</option>
                        <option value="3XL">4XL</option>
                        <option value="3XL">5XL</option>
                    </select>
                </div>

                <!-- Size options for Adult Short Sleeves -->
                <div id="size_short" class="size-chart" style="display: none;">
                    <label>Size (Adult Short Sleeves):</label><br>
                    <select name="size_short">
                        <option value="">-- Select Size --</option>
                        <option value="S">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="2XL">2XL</option>
                        <option value="3XL">3XL</option>
                        <option value="3XL">4XL</option>
                        <option value="3XL">5XL</option>
                    </select>
                </div>
                    
                </select><br>

                    <label for="order_date">Order Date:</label>
                    <input type="date" id="order_date" name="order_date" required>

                    <label for="due_date">Due Date:</label>
                    <input type="date" id="due_date" name="due_date" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>

                    <label for="notes">Notes:</label>
                    <textarea id="notes" name="notes" rows="4"></textarea>

                    <button type="submit" name="submit_order" class="btn-submit">Submit Order</button>
                </form>
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
                <script>
                function showSizeOptions() {
                    const selectedType = document.getElementById("order_type").value;

                    // Hide all size dropdowns first
                    document.querySelectorAll('.size-chart').forEach(div => div.style.display = 'none');

                    // Show the one that matches the selection
                    if (selectedType === "Muslimah Clothes") {
                        document.getElementById("size_muslimah").style.display = 'block';
                    } else if (selectedType === "Kids Clothes") {
                        document.getElementById("size_kids").style.display = 'block';
                    } else if (selectedType === "Adult Long Sleeves") {
                        document.getElementById("size_long").style.display = 'block';
                    } else if (selectedType === "Adult Short Sleeves") {
                        document.getElementById("size_short").style.display = 'block';
                    }
                }
                </script>
            </body>
            </html>