<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
    <nav role="navigation" class="navbar">
        <div class="nav-title all-caps">Quattro Formaggi</div>
        <input class="menu-btn" type="checkbox" id="menu-btn" onchange="myFunction(this)"/>
        <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
        <div id="nav-list">
            <?php wp_nav_menu(); ?>
            <div class="navbar-order all-caps">Order</div>
        </div>
        
    </nav>
    <script>
        function myFunction(checkboxElem) {
            var x = document.getElementById("nav-list");
            if (checkboxElem.checked) {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            }
    </script>
    </header>    
    
    
<?php wp_body_open(); ?>