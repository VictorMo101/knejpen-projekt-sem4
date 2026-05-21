<!DOCTYPE html>
<html lang="da">
<head>
    <?php wp_head(); ?>
    <title><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body <?php body_class(); ?>>
<header class="site-header" role="banner">
    <a tabindex="0" aria-label="Knejpen" class="site-brand" href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Knejpen</a>

    <nav class="site-nav" aria-label="Primary">
        <div class="desktop-nav">
            <a tabindex="0" aria-label="Hjem" href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Hjem</a>
            <a tabindex="0" aria-label="Om os" href="<?php echo esc_url( home_url( '/#about' ) ); ?>">Om os</a>
            <a tabindex="0" aria-label="Begivenheder" href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Begivenheder</a>
            <a tabindex="0" aria-label="Sociale Medier" href="<?php echo esc_url( home_url( '/#media' ) ); ?>">Sociale Medier</a>
            <a tabindex="0" aria-label="Menu" href="<?php echo esc_url( home_url( '/#menu' ) ); ?>">Menu</a>
        </div>
        <button class="burger-btn">☰</button>
        <div class="phone-nav">
            <a tabindex="0" aria-label="Hjem" href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Hjem</a>
            <a tabindex="0" aria-label="Om os" href="<?php echo esc_url( home_url( '/#about' ) ); ?>">Om os</a>
            <a tabindex="0" aria-label="Begivenheder" href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Begivenheder</a>
            <a tabindex="0" aria-label="Sociale Medier" href="<?php echo esc_url( home_url( '/#media' ) ); ?>">Sociale Medier</a>
            <a tabindex="0" aria-label="Menu" href="<?php echo esc_url( home_url( '/#menu' ) ); ?>">Menu</a>
        </div>
    </nav>
</header>
<div class="scroll-up-indicator">
    <a tabindex="0" aria-label="Rul op" href="<?php echo esc_url( home_url( '/#home' ) ); ?>" class="scroll-up-link" aria-label="Scroll to top">
        <svg class="scroll-up-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" focusable="false" aria-hidden="true">
            <path fill="currentColor" d="M12 16.5 5 9.5l1.4-1.4L12 13.7l5.6-5.6L19 9.5z"/>
        </svg>
    </a>
</div>