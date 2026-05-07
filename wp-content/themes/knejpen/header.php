<!DOCTYPE html>
<html>
<head>
    <?php wp_head(); ?>
</head>
<body <?php body_class('has-fixed-header'); ?>>
<header class="site-header" role="banner">
    <a class="site-brand" href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Knejpen</a>

    <nav class="site-nav" aria-label="Primary">
        <a href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Home</a>
        <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">About</a>
        <a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Events</a>
    </nav>
</header>