<?php
if( get_field('enable_slider') ):
    if( have_rows('slider', 266) ): ?>
        <div class="site-slider">
            <div class="container">
                <div class="slides">
                <?php
                while ( have_rows('slider', 266) ) : the_row();
                    $image = get_sub_field('client_logo');

                    // thumbnail
                    $size = 'client_logo';
                    $thumb = $image['sizes'][ $size ];
                    // $width = $image['sizes'][ $size . '-width' ];
                    // $height = $image['sizes'][ $size . '-height' ];

                    if( $image ):
                    echo '<div class="site-slider-logo">';
                        echo '<img src="'. $thumb .'" alt="'. $image['alt'] .'" class="logo">';
                    echo '</div>';
                    endif;
                endwhile; ?>
                </div>
            </div>
        </div>
    <?php
    endif;
endif;