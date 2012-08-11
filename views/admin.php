<div class="wrapper">
  <fieldset>
    <legend>
      <?php echo _e('mojoLive Widget Settings'); ?>
    </legend>

    <div class="option">
      <label for="mojolive-widget-username">
        <?php echo _e('mojoLive Username'); ?>
      </label>

      <input
        type="text"
        id="mojolive-widget-username"
        name="<?php echo $this->get_field_name('username'); ?>"
        value="<?php echo !empty($instance['username']) ? esc_html($instance['username']) : null; ?>"
        class="">
    </div>

  </fieldset>
</div><!-- /wrapper -->
