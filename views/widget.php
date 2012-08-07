<style type="text/css">

.mojolive-widget-badge {
  background-image: url("http://www.mojolive.com/img/icons/mojo.asterisk.50x50.png");
  background-position: 10px 10px;
  background-repeat: no-repeat;
  color: #009347;
  font-family: "Gibson SemiBold","Arial Bold";
  text-align: right;

  position: relative;
  z-index: 1000;
  background-color: #fff;
  border: 3px solid #009347;
  box-shadow: #999;
  box-shadow: 0 10px 10px rgba(0,0,0,0.2);
  -moz-box-shadow: 0 10px 10px rgba(0,0,0,0.2);
  -webkit-box-shadow: 0 10px 10px rgba(0,0,0,0.2);
  height: 100px;
  width: 132px;
  padding: 64px 10px 10px;
  font-size: 84px;
  border-radius: 12px;
}

.mojolive-widget-badge img {
  position: absolute;
  top: 10px;
  right: 10px;
}
</style>
<div class="mojolive-widget">
  <img src="http://mojolive.com/img/basic/header.logo.png" />
  <div class="mojolive-widget-badge">
    <?php
    $image = '<img src="' . esc_html($image_url) . '" />';
    ?>
    <a href="<?php echo esc_html($profile_url) ?>" title="View my profile on mojoLive">
      <?php echo $image; ?>
    </a>

    <p><?php echo esc_html($score); ?></p>
  </div>
</div>
