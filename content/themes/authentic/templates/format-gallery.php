<?php $images = _get_field( 'csco_post_gallery' ); ?>
<?php if ($images) { ?>
  <?php $gallery_type = _get_field('csco_post_gallery_type'); ?>

  <?php if ($gallery_type == 'slider') { ?>

    <div class="gallery gallery-slider owl-container owl-simple">

      <div class="owl-carousel">
        <?php foreach($images as $image) { ?>
          <div class="owl-slide">
            <figure>
              <?php echo wp_get_attachment_link( $image['id'], 'large', false, false, false ); ?>
            </figure>
          </div>
        <?php } ?>
      </div>

      <div class="owl-dots"></div>

    </div>

  <?php } elseif ($gallery_type == 'justified') { ?>

    <div class="gallery gallery-justified">
      <?php foreach($images as $image) { ?>
        <figure>
          <?php echo wp_get_attachment_link( $image['id'], 'large', false, false, false ); ?>
        </figure>
      <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
