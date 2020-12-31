<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Projects
 * @subpackage Wprem_Projects/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wprem_Projects
 * @subpackage Wprem_Projects/public
 * @author     Sergio Cutone <sergio.cutone@yp.ca>
 */
class Wprem_Projects_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wprem_Projects_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wprem_Projects_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wprem-projects-public.css', array(), $this->version, 'all');
        wp_enqueue_style('jquery-bxslider', plugins_url() . '/bb-plugin/css/jquery.bxslider.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wprem_Projects_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wprem_Projects_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wprem-projects-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script('jquery-bxslider', plugins_url() . '/bb-plugin/js/jquery.bxslider.js', array('jquery'), false, false);

    }

    private function slider($args, $atts)
    {
        $projects_query = new WP_Query($args);

        echo '<div class="wp-project-gallery"><div class="project-slider text-' . $atts['align'] . '" data-dots="' . $atts['dots'] . '" data-margin="' . $atts['margin'] . '" data-cols="' . $atts['columns'] . '" data-auto="' . $atts['auto'] . '" data-captions="' . $atts['captions'] . '">';

        while ($projects_query->have_posts()) {
            $projects_query->the_post();
            $a = ['', ''];
            if ($atts['link']) {
                $a = ['<a href="' . get_the_permalink() . '">', '</a>'];
            }
            echo '<div>' . $a[0] . '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" title="' . get_the_title() . '"/>' . $a[1] . '</div>';
        };

        echo '</div></div>';
    }

    public function projects_shortcode($atts)
    {
        ob_start();

        $atts = shortcode_atts(
            array(
                'margin' => 0,
                'columns' => 1,
                'auto' => false,
                'captions' => false,
                'link' => false,
                'dots' => false,
                'align' => 'left',
                'height' => '',
            ), $atts);

        $args_projects = array(
            'post_status' => 'publish',
            'post_type' => WPREM_PROJECTS_CUSTOM_POST_TYPE,
            'meta_key' => '_data_order',
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $a = ['', ''];

        $this->slider($args_projects, $atts);

        return ob_get_clean();
    }

    public function single_project_content($content)
    {
        global $post;
        if (is_singular(WPREM_PROJECTS_CUSTOM_POST_TYPE)) {
        }
        return $content;
    }

}
