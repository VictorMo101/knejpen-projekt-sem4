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
        <h1>Knejpen gi'er</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unk sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unk sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.A </p>
        </div>
   
        <div class="about-image">
            <img src="https://picsum.photos/500/500" alt="test ong">
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

    <div class="events-wrapper">
        <a href="#">
            <div class="event-card">
                <div class="event-img">
                    <img src="https://picsum.photos/500/500" alt="Venue photo" />
                    <div class="event-img-overlay"><img src="<?php echo esc_url('https://knejpen-projekt.dk/wp-content/uploads/2026/05/wine-glass-svgrepo-com-11.png'); ?>" alt="location-pin">Kongensgade 19, 6700 Esbjerg</div>
                </div>
        
                <div class="event-body">
                    <div class="event-meta">
                        <span>June 6th 2016</span>
                        <span class="sep">|</span>
                        <span>KL 8 til KL 9</span>
                        <span class="sep">|</span>
                    </div>
                    <div class="event-title">lorem ipsum </div>
                    <div class="event-sub">lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum </div>
                </div>
            </div>
        </a>

    </div>
</section>

<section class="section-break" style="background-image: url('<?php echo esc_url('http://knejpen-projekt.dk/wp-content/uploads/2026/05/knejpen-background.png'); ?>'); background-size: cover; background-position: center; background-attachment: fixed;"></section>

<section id="media">
    <div class="outer-media">
        <div class="media-container">
            <div class="image" style="grid-area: box-1"><img src="https://picsum.photos/500/500" alt="Venue photo" /></div>
            <div class="image" style="grid-area: box-2"><img src="https://picsum.photos/700/400" alt="Venue photo" /></div>
            <div class="image" style="grid-area: box-3"><img src="https://picsum.photos/700/600" alt="Venue photo" /></div>
            <div class="image" style="grid-area: box-4"><img src="https://picsum.photos/200/100" alt="Venue photo" /></div>
            <div class="image" style="grid-area: box-5"><img src="https://picsum.photos/900/200" alt="Venue photo" /></div>
            <div class="image" style="grid-area: box-6"><img src="https://picsum.photos/900/900" alt="Venue photo" /></div>
            <div class="image" style="grid-area: box-7"><img src="https://picsum.photos/100/100" alt="Venue photo" /></div>
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