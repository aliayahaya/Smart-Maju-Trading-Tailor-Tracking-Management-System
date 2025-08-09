<?php
session_start();

// Connect to DB
$con = mysqli_connect("localhost", "root", "", "tailortrack") or die(mysqli_connect_error());

// Get the order_id from URL
if (isset($_GET['order_id'])) {
    $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
    
    // Fetch order details from the database
    $query = "SELECT * FROM `order` WHERE order_id = '$order_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
    } else {
        echo "Order not found!";
        exit;
    }
} else {
    echo "Order ID is required!";
    exit;
}

// Handle form submission to update the order
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
    
    // Update the order in the database
    $update_query = "UPDATE `order` SET 
                        service_type = '$service_type',
                        order_type = '$order_type',
                        size = '$size',
                        order_date = '$order_date',
                        due_date = '$due_date',
                        quantity = '$quantity',
                        notes = '$notes'
                    WHERE order_id = '$order_id'";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Order updated successfully'); window.location.href = 'update order.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link href="https://cdn.prod.website-files.com/66e3df8d47eb3991ca9dbef7/css/wealth-bento-webflow-template.webflow.2c90d30fb.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({ google: { families: ["Inter:100,300,regular,500,600,700,100italic,300italic,italic,500italic,600italic,700italic"] } });</script>
    <style>
        /* Add padding to the form container */
        .container {
            margin-top: 100px;
        }
        .container form h3 {
            margin-top: 50px;
            padding-left: 35px;
        }
        .edit-order-form {
            padding: 20px;
            margin-top: 50px;
            margin-left: 30px;
            margin-right: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .edit-order-form label {
            display: block;
            margin: 10px 0 5px;
        }

        .edit-order-form input, .edit-order-form select, .edit-order-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .edit-order-form textarea {
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

    <!-- Header -->
    <div data-animation="default" class="navbar w-nav" data-easing2="ease" data-easing="ease" data-collapse="medium" data-w-id="06ab6c64-468c-b44e-1b8c-856deb96ba7f" role="banner" data-no-scroll="1" data-duration="400" data-doc-height="1">
            <a href="/" aria-current="page" class="logo-link-wrapper w-nav-brand w--current">
                <img src="logo.jpg" alt="Logo" class="logo" style="width: auto; height: 100px; max-height: none;">
            </a>
        <div class="nav-container w-container">
            <nav role="navigation" class="nav-menu w-nav-menu">
                <div class="nav-link-wrapper">
                    <a href="update order.php" class="nav-link w-nav-link">Back</a>
                    <a href="update order.php" class="nav-link move-down hide-on-tab w-nav-link">Back</a>
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

            <!-- Form to edit order details -->
            <form class="edit-order-form" method="POST" action="edit_order.php?order_id=<?php echo $order_id; ?>">
                <h3>Edit Order</h3>
                <label for="service_type">Service Type:</label>
                <select id="service_type" name="service_type" required>
                    <option value="Embroidery Services" <?php echo ($order['service_type'] == 'Embroidery Services') ? 'selected' : ''; ?>>Embroidery Services</option>
                    <option value="Formal & Casual Wear Customization" <?php echo ($order['service_type'] == 'Formal & Casual Wear Customization') ? 'selected' : ''; ?>>Formal & Casual Wear Customization</option>
                    <option value="Custom Garment Making" <?php echo ($order['service_type'] == 'Custom Garment Making') ? 'selected' : ''; ?>>Custom Garment Making</option>
                    <option value="Alterations & Repairs" <?php echo ($order['service_type'] == 'Alterations & Repairs') ? 'selected' : ''; ?>>Alterations & Repairs</option>
                    <option value="Fabric Sourcing" <?php echo ($order['service_type'] == 'Fabric Sourcing') ? 'selected' : ''; ?>>Fabric Sourcing</option>
                </select>

                <label for="order_type">Order Type:</label>
                <select id="order_type" name="order_type" required>
                    <option value="Muslimah Clothes" <?php echo ($order['order_type'] == 'Muslimah Clothes') ? 'selected' : ''; ?>>Muslimah Clothes</option>
                    <option value="Kids Clothes" <?php echo ($order['order_type'] == 'Kids Clothes') ? 'selected' : ''; ?>>Kids Clothes</option>
                    <option value="Adult Long Sleeves" <?php echo ($order['order_type'] == 'Adult Long Sleeves') ? 'selected' : ''; ?>>Adult Long Sleeves</option>
                    <option value="Adult Short Sleeves" <?php echo ($order['order_type'] == 'Adult Short Sleeves') ? 'selected' : ''; ?>>Adult Short Sleeves</option>
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
                <input type="date" id="order_date" name="order_date" value="<?php echo $order['order_date']; ?>" required>

                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" value="<?php echo $order['due_date']; ?>" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $order['quantity']; ?>" required>

                <label for="notes">Notes:</label>
                <textarea id="notes" name="notes" rows="4"><?php echo $order['notes']; ?></textarea>

                <button type="submit" name="submit_order" class="btn-submit">Update Order</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <section class="section background-black">
        <div class="w-layout-blockcontainer container padding-4-5rem w-container">
            <div class="space-2rem"></div>
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
                            <img width="Auto" height="Auto" alt="" src="tiktok.png" loading="eager" srcset="tiktok.png 500w, tiktok.png 512w" sizes="(max-width: 512px) 100vw, 512px" class="social-icon smaller"/>
                        </a>
                    </div>
                    <p class="max-width-17vw font-white">Sewing Services & Supply of Fabrics and Clothing.</p>
                </div>
            </div>
            <div class="footer-right-flex">
                <div class="footer-wrapper">
                    <h5 class="font-white">Main</h5>
                    <div class="footer-link-wrapper">
                        <a href="logout.php" class="footer-link">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Smooth scroll to top
        document.getElementById("backToTop").addEventListener("click", function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>
    <script>
        // Function to show the correct size chart
        function toggleSizeChart() {
            const orderType = document.getElementById("order_type").value;

            // Hide all first
            document.querySelectorAll('.size-chart').forEach(div => div.style.display = 'none');

            // Show based on selected order type
            if (orderType === "Muslimah Clothes") {
                document.getElementById("size_muslimah").style.display = 'block';
            } else if (orderType === "Kids Clothes") {
                document.getElementById("size_kids").style.display = 'block';
            } else if (orderType === "Adult Long Sleeves") {
                document.getElementById("size_long").style.display = 'block';
            } else if (orderType === "Adult Short Sleeves") {
                document.getElementById("size_short").style.display = 'block';
            }
        }

        // Bind change event on page load
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("order_type").addEventListener("change", toggleSizeChart);
            toggleSizeChart(); // call once to display correct size chart on page load
        });
    </script>

</body>
</html>
