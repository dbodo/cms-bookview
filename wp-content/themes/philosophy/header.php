<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title>
        <?php the_title(); ?>
    </title> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="s-pageheader">
        <header class="header">
            <div class="header__content row">
                <div class="header__logo">
                    <a class="logo" href="index.html">
                        <img src="<?php bloginfo('template_directory'); ?>/images/logoBookView2.png" alt="Homepage">
                    </a>
                </div> <!-- end header__logo -->
                    <?php
                        if(is_active_sidebar('footer-sidebar-5')){
                        dynamic_sidebar('footer-sidebar-5');
                        }
                    ?>                   
                <a href="#0" class="header__toggle-menu" title="Menu"><span>Menu
                    </span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <ul class="header__nav">
                        <?php
                        $args = array(
                          'theme_location' => 'glavni-menu',
                            'menu_id' => 'vsmti-glavni-menu'
                             );
                        wp_nav_menu( $args );
                        ?>
                    </ul> <!-- end header__nav -->

                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                </nav> <!-- end header__nav-wrap -->

            </div> <!-- header-content -->
        </header> <!-- header -->
    </div> <!-- end s-pageheader -->
