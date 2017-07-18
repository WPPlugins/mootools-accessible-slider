<?php
/*
Plugin Name: MooTools Accessible Slider
Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-slider/
Description: WAI-ARIA Enabled Slider Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "MooToolsAccessibleSlider_init");
function MooToolsAccessibleSlider_init() {
    register_sidebar_widget(__('MooTools Accessible Slider'), 'widget_MooToolsAccessibleSlider');
    register_widget_control(   'MooTools Accessible Slider', 'MooToolsAccessibleSlider_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_MooToolsAccessibleSlider') ) {
        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('mootools-core', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-slider/lib/mootools-core.js'));
        wp_enqueue_script('mootools-core');

        wp_register_script('mootools-more', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-slider/lib/mootools-more.js'));
        wp_enqueue_script('mootools-more');
		
		wp_register_script('slider', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-slider/lib/slider.js'));
        wp_enqueue_script('slider');

        wp_register_script('MooToolsAccessibleSlider', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-slider/lib/MooToolsAccessibleSlider.js'));
        wp_enqueue_script('MooToolsAccessibleSlider');

        wp_register_style('MooToolsAccessibleSlider_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-slider/lib/MooToolsAccessibleSlider.css'));
        wp_enqueue_style('MooToolsAccessibleSlider_css');
    }
}

function widget_MooToolsAccessibleSlider($args) {
    extract($args);

    $options = get_option("widget_MooToolsAccessibleSlider");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Slider',
            'label' => 'Number of posts to show',
            'info' => 'Move the slider to select the number of posts to show'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    MooToolsAccessibleSliderContent();
    echo $after_widget;
}

function MooToolsAccessibleSliderContent() {
    $options = get_option("widget_MooToolsAccessibleSlider");
    if (!is_array($options)) {
        $options = array(
            'title' => 'MooTools Accessible Slider',
            'label' => 'Number of posts to show',
            'info' => 'Move the slider to select the number of posts to show'
        );
    }

    echo '
    
    <div class="demo" role="application">
			<label for="slider">' . $options['label'] . '</label>
            <br />
            <span id="slider1ValMooToolsAccessible" class="sliderValueMooToolsAccessible">#0</span>
            <br />
			<div id="sliderMooToolsAccessible" class="slider">
				<div class="knob">
				</div>
			</div>
			<div id="areaBSliderMooToolsAccessible">
			</div>
		</div>';
}

function MooToolsAccessibleSlider_control() {
    $options = get_option("widget_MooToolsAccessibleSlider");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'MooTools Accessible Slider',
            'label' => 'Number of posts to show',
            'info' => 'Move the slider to select the number of posts to show'
        );
    }

    if ($_POST['MooToolsAccessibleSlider-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['MooToolsAccessibleSlider-WidgetTitle']);
        update_option("widget_MooToolsAccessibleSlider", $options);
    }
    if ($_POST['MooToolsAccessibleSlider-SubmitLabel']) {
        $options['label'] = htmlspecialchars($_POST['MooToolsAccessibleSlider-WidgetLabel']);
        update_option("widget_MooToolsAccessibleSlider", $options);
    }
    if ($_POST['MooToolsAccessibleSlider-SubmitInfo']) {
        $options['info'] = htmlspecialchars($_POST['MooToolsAccessibleSlider-WidgetInfo']);
        update_option("widget_MooToolsAccessibleSlider", $options);
    }
    ?>
    <p>
        <label for="MooToolsAccessibleSlider-WidgetTitle">Widget Title: </label>
        <input type="text" id="MooToolsAccessibleSlider-WidgetTitle" name="MooToolsAccessibleSlider-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="MooToolsAccessibleSlider-SubmitTitle" name="MooToolsAccessibleSlider-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleSlider-WidgetLabel">Translation for "Number of posts to show": </label>
        <input type="text" id="MooToolsAccessibleSlider-WidgetLabel" name="MooToolsAccessibleSlider-WidgetLabel" value="<?php echo $options['label'];?>" />
        <input type="hidden" id="MooToolsAccessibleSlider-SubmitLabel" name="MooToolsAccessibleSlider-SubmitLabel" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleSlider-WidgetInfo">Translation for "Move the slider to select the number of posts to show": </label>
        <input type="text" id="MooToolsAccessibleSlider-WidgetInfo" name="MooToolsAccessibleSlider-WidgetInfo" value="<?php echo $options['info'];?>" />
        <input type="hidden" id="MooToolsAccessibleSlider-SubmitInfo" name="MooToolsAccessibleSlider-SubmitInfo" value="1" />
    </p>
    
    <?php
}

?>
