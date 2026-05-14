<?php get_header(); ?>
<section id="home">
    <div class="video-wrap">
        <video autoplay muted loop playsinline>
            <source src="<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/knejpen-hero-video.mp4'); ?>" alt="Knejpen Video" type="video/mp4">
        </video>

        <div class="video-overlay">
            <img src="<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/knejpen-hero-billede.png'); ?>" alt="Knejpen Logo">
        </div>
    </div>
</section>

<section id="about">
    <div class="about-container">
        <div class="about-text">
        <h1><?php echo esc_html(get_field('about-title')); ?></h1>
        <p><?php echo wp_kses_post(get_field('about-description')); ?></p>
        </div>
        <div class="about-image">
            <img src="<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/IMG20260502172903-scaled.jpg'); ?>" alt="test ong">
        </div>
    </div>
</section>


<section id="events" style="background-image: url('<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/knejpen-background.png'); ?>'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="events-container">
        <span class="events-line"></span><p class="star">★</p>
            <h2>Begivenheder</h2>
        <p class="star">★</p><span class="events-line"></span>
        </div>
    </div>

    <?php
        $args = array(
            'post_type'      => 'events',
            'posts_per_page' => -1
        );
        $events_query = new WP_Query($args);

        if ( $events_query->have_posts() ) :
        ?>
<div class="events-carousel-wrapper">
    <div class="events-wrapper" id="eventsWrapper">
        <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
            <?php $event_img = get_field('event-img'); ?>
            <a href="<?php the_permalink(); ?>">
                <div class="event-card">
                    <div class="event-img">
                        <?php if ( $event_img ) : ?>
                            <img 
                                src="<?php echo esc_url($event_img['url']); ?>" 
                                alt="<?php echo esc_attr($event_img['alt']); ?>"
                            >
                        <?php endif; ?>
                        <div class="event-img-overlay">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#FEF2A6" class="size-30" aria-label="Location Pin Icon">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <p class="event-place"><?php the_field('event-place'); ?></p>
                            <svg class="event-external" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#FEF2A6" class="size-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>

                        </div>
                    </div>

                    <div class="event-body">
                        <div class="event-meta">
                            <span><?php the_field('event_date'); ?></span>
                            <span class="sep">|</span>
                            <span><?php the_field('event-time'); ?></span>
                            <span class="sep">|</span>
                            <span><?php the_field('event-price'); ?></span>
                        </div>

                        <div class="event-title">
                            <?php the_field('event-title'); ?>
                        </div>

                        <div class="event-sub">
                            <?php the_field('event-des'); ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
    
    <?php if ( $events_query->found_posts > 3 ) : ?>
        <button class="events-scroll-btn events-scroll-btn-left is-hidden" id="eventsScrollBtnLeft" aria-label="Scroll to previous events">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="2" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button class="events-scroll-btn events-scroll-btn-right is-hidden" id="eventsScrollBtnRight" aria-label="Scroll to next events">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="2" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    <?php endif; ?>
</div>

<?php
    wp_reset_postdata();
    endif;
?>
</section>


<section id="media">
    <div class="outer-media">
        <div class="media-container">
            <?php
            $areas = array('box-1', 'box-2', 'box-3', 'box-4', 'box-5', 'box-6', 'box-7');

            $media_query = new WP_Query(array(
                'post_type'      => 'media-image',
                'posts_per_page' => 7,
            ));

            if ($media_query->have_posts()) :
                $i = 0;
                while ($media_query->have_posts()) : $media_query->the_post();
                    if (!isset($areas[$i])) {
                        break;
                    }

                    $image = get_field('image');
                    if ($image) :
            ?>
                        <div class="image" style="grid-area: <?php echo esc_attr($areas[$i]); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
            <?php
                    endif;
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <button class="facebook-button">Følg os på Facebook</button>
    </div>
</section>

<section class="section-break" style="background-image: url('<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/knejpen-background.png'); ?>'); background-size: cover; background-position: center; background-attachment: fixed;"></section>

<section id="menu">
    <div class="menu-container">
        <div class="corner-lt"></div>
        <div class="corner-rt"></div>
        <div class="corner-lb"></div>
        <div class="corner-rb"></div>
        <div class="menu-inner-border"></div>
        <div class="corner-inner-lt"></div>
        <div class="corner-inner-rt"></div>
        <div class="corner-inner-lb"></div>
        <div class="corner-inner-rb"></div>
        <div class="menu-card-container">
            <div class="menu-card-header">
                <span class="events-line"></span><p class="star">★</p>
                <?php $drinks_post_type = get_post_type_object('drinks'); ?>
                <h2><?php echo esc_html($drinks_post_type ? $drinks_post_type->labels->name : 'Drinks'); ?></h2>
                <p class="star">★</p><span class="events-line"></span>
            </div>
            <div class="menu-card-grid">
            <?php
            $args = array(
                'post_type' => 'drinks',
                'posts_per_page' => -1,
            );
            $menu_query = new WP_Query($args);

            if($menu_query->have_posts()) :
                while($menu_query->have_posts()) : $menu_query->the_post();

                    $icon = get_field('drinks-icon');
                    $title = get_field('drinks-titel');
                    $description = get_field('drinks-des');
                    $price = get_field('drinks-price');
            ?>
            <div class="menu-card-col">
                <div class="menu-card-item">

                    <?php if($icon): ?>
                        <img class="menu-item-icon" src="<?php echo esc_url($icon['url']); ?>"
                                alt="<?php echo esc_attr($icon['alt']); ?>">
                    <?php endif; ?>

                    <div class="menu-item-dis">
                        <h3><?php echo esc_html($title); ?></h3>
                        <p><?php echo esc_html($description); ?></p>
                    </div>
                    
                    <p class="menu-item-price"><?php echo esc_html($price); ?>,-</p>

                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="menu-card-header">
            <span class="events-line"></span><p class="star">★</p>
            <?php $drinks_post_type = get_post_type_object('beer-shot'); ?>
            <h2><?php echo esc_html($drinks_post_type ? $drinks_post_type->labels->name : 'ØL & SHOTS'); ?></h2>
            <p class="star">★</p><span class="events-line"></span>
        </div>
        <div class="menu-card-grid">
        <?php
        $args = array(
            'post_type' => 'beer-shot',
            'posts_per_page' => -1,
        );
        $menu_query = new WP_Query($args);

        if($menu_query->have_posts()) :
            while($menu_query->have_posts()) : $menu_query->the_post();

                $beershoticon = get_field('beer-shot-image');
                $beershottitle = get_field('beer-shot-name');
                $beershotprice = get_field('beer-shot-price');
        ?>
        <div class="menu-card-col">
            <div class="menu-card-item">

                <?php if($beershoticon): ?>
                    <img class="menu-item-icon" src="<?php echo esc_url($beershoticon['url']); ?>"
                            alt="<?php echo esc_attr($beershoticon['alt']); ?>">
                <?php endif; ?>

                <div class="menu-item-dis">
                    <h3><?php echo esc_html($beershottitle); ?></h3>
                </div>

                <p class="menu-item-price"><?php echo esc_html($beershotprice); ?>,-</p>

            </div>
        </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

<section class="section-break" style="background-image: url('<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/knejpen-background.png'); ?>'); background-size: cover; background-position: center; background-attachment: fixed;"></section>

<?php get_footer(); ?>