<div class="mojolive-widget">
  <div class="mojolive-widget-badge">
    <?php
    $image = '<img src="' . esc_html($image_url) . '"  width="77" height="77" alt="mojoLive profile image for ' . esc_html($username) . '" />';
    ?>
    <div class="mojolive-widget-profile-image">
      <a href="<?php echo esc_html($profile_url) ?>" title="View my profile on mojoLive">
        <?php echo $image; ?>
      </a>
      <div class="clearboth"></div>
    </div>

    <p><?php echo esc_html($score); ?></p>
    <div class="mojolive-widget-logo"></div>
  </div>
</div>
