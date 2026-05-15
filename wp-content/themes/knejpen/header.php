<!DOCTYPE html>
<html lang="da">
<head>
    <?php wp_head(); ?>
    <title>Knejpen</title>
    <meta name="description" content="Knejpen, Esbjergs lokale bar">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body <?php body_class(); ?>>
<header class="site-header" role="banner">
    <a class="site-brand" href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Knejpen</a>

    <nav class="site-nav" aria-label="Primary">
        <a href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Hjem</a>
        <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">Om os</a>
        <a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Begivenheder</a>
        <a href="<?php echo esc_url( home_url( '/#media' ) ); ?>">Sociale Medier</a>
        <a href="<?php echo esc_url( home_url( '/#menu' ) ); ?>">Menu</a>
    </nav>

    <nav class="site-nav" aria-label="Primary">

    <button class="burger-btn">☰</button>

    <a href="<?php echo esc_url( home_url( '/#home' ) ); ?>">Hjem</a>
    <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">Om os</a>
    <a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Begivenheder</a>
    <a href="<?php echo esc_url( home_url( '/#media' ) ); ?>">Sociale Medier</a>
    <a href="<?php echo esc_url( home_url( '/#menu' ) ); ?>">Menu</a>

    </nav>
</header>