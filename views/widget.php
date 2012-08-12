<div class="mojolive-widget">
  <div class="mojolive-widget-badge">
    <?php
    $image = '<img src="' . esc_html($image_url) . '" />';
    ?>
    <a href="<?php echo esc_html($profile_url) ?>" title="View my profile on mojoLive">
      <?php echo $image; ?>
    </a>

    <p><?php echo esc_html($score); ?></p>
    <img class="mojolive-widget-logo" src="<?php echo plugins_url( 'img/mojolive.png', dirname(__FILE__) ) ?>" />
  </div>
</div>
