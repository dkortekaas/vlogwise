<?php
if( get_field('enable_slider') ):
    if( have_rows('slider') ): ?>
        <div class="site-slider">
            <div class="container">
            <?php
            while ( have_rows('slider') ) : the_row();
                $image = get_sub_field('client_logo');
                if( $image ):
                echo '<div class="site-slider-logo">';
                    echo '<img src="'. echo $image['url']; .'" alt="'. echo $image['alt'] .'" class="logo">';
                echo '</div>';
                endif;
            endwhile; ?>
            </div>
        </div>
    <?php
    endif;
endif;