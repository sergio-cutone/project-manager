<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Projects
 * @subpackage Wprem_Projects/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wprem_Projects
 * @subpackage Wprem_Projects/admin
 * @author     Sergio Cutone <sergio.cutone@yp.ca>
 */
class Wprem_Projects_Admin
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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wprem-projects-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wprem-projects-admin.js', array('jquery'), $this->version, false);

    }

    //======================================================================
    // CREATE ADMIN MENU
    //======================================================================
    public function menu_settings()
    {
        add_submenu_page(
            'edit.php?post_type=' . WPREM_PROJECTS_CUSTOM_POST_TYPE,
            'Settings', // The title to be displayed in the browser window for this page.
            'Settings', // The text to be displayed for this menu item
            'manage_options', // Which type of users can see this menu item
            $this->plugin_name, // The unique ID - that is, the slug - for this menu item
            array($this, 'settings_page') // The name of the function to call when rendering this menu's page
        );
    }
    //======================================================================
    // ADD SHORTCODE BUTTON
    //======================================================================
    public function add_button($x)
    {
        echo '<a href="#TB_inline?width=480&height=500&inlineId=wp_projects_shortcode" class="button thickbox wp_doin_media_link" id="add_div_shortcode">PJ</a>';
    }
    public function shortcode_popup()
    {
        ?>
        <div id="wp_projects_shortcode">
            <div class="wrap wp_doin_shortcode admin-projects">
                <div class="inner">
                    <h3>Projects Shortcode</h3>
                    <p>Margin</p>
                    <div class="field-container">
                        <input type="number" id="wp_margins" maxlength="2" />px
                    </div>
                    <p><label for="wp_cols">Amount of Columns</p>
                    <div class="field-container">
                        <select name="wp_cols" id="wp_cols">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="field-container">
                        <p>
                            <input type="checkbox" name="wp_auto" id="wp_auto" value="1" /> <label for="wp_auto">Auto Slide</label>
                        </p>
                    </div>
                    <div class="field-container">
                        <p>
                            <input type="checkbox" name="wp_captions" id="wp_captions" value="1" /> <label for="wp_captions">Show Captions</label>
                        </p>
                    </div>
                    <div class="field-container">
                        <p>
                            <input type="checkbox" name="wp_link" id="wp_link" value="1" /> <label for="wp_link">Link Project</label>
                        </p>
                    </div>
                    <div class="field-container">
                        <p>
                            <input type="checkbox" name="wp_pagination" id="wp_pagination" value="1" /> <label for="wp_pagination">Slider Pagination</label>
                        </p>
                    </div>
                    <p>
                        <input type="button" class="button-primary" value="Insert Projects" id="project-insert" /> <a class="button" href="#" onclick="tb_remove(); return false;">Cancel</a>
                    </p>
                </div>
            </div>
        </div>
            <?php
}
    //======================================================================
    // SETTINGS PAGE
    //======================================================================
    public function settings_page()
    {
        include_once 'partials/wprem-projects-admin-display.php';
    }
    //======================================================================
    // SET CONTENT TYPE
    //======================================================================
    public function content_types()
    {
        $panels_arr = array(
            array(
                'id' => '_data_tabs_panel_1', 'title' => 'Main Information',
                'fields' => array(
                    array(
                        'id' => '_data_title', 'label' => 'Title', 'type' => 'text',
                    ),
                    array(
                        'id' => '_data_completion_date', 'label' => 'Completion Date', 'type' => 'date',
                    ),
                    array(
                        'id' => '_data_features', 'label' => 'Features', 'type' => 'wysiwyg',
                    ),
                    array(
                        'id' => '_data_url', 'label' => 'URL', 'type' => 'text',
                    ),
                    array(
                        'id' => '_data_order', 'label' => 'Order', 'type' => 'text', 'default_value' => '0',
                    ),
                ),
            ),
        );

        if (is_plugin_active('wprem-gallery/wprem-gallery.php')) {
            $gallery = array(
                'id' => '_data_image',
                'type' => 'post_select',
                'label' => 'Gallery Images',
                'args' => array(
                    'post_type' => 'wprem_gallery',
                ),
            );
            array_push($panels_arr[0]['fields'], $gallery);
        }

        $exludefromsearch = (esc_attr(get_option('wprem_searchable_wprem-projects')) === "1") ? false : true;
        $args = array(
            'exclude_from_search' => $exludefromsearch,
            'rewrite' => array(
                'slug' => 'project',
                'with_front' => false,
            ),
            "menu_icon" => "dashicons-portfolio",
            'labels' => array(
                "name" => "Project",
                'menu_name' => 'Projects',
                "add_new" => "Add New Project",
                "add_new_item" => "Add New Project",
                "all_items" => "All Projects",
            ),
            "has_archive" => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
            ),
            'taxonomies' => array('post_tag'),
        );
        $project = register_cuztom_post_type(WPREM_PROJECTS_CUSTOM_POST_TYPE, $args);

        $category = register_cuztom_taxonomy(
            'wprem_projects_industry',
            WPREM_PROJECTS_CUSTOM_POST_TYPE,
            array(
                'labels' => array(
                    'name' => __('Industries', 'cuztom'),
                    'menu_name' => __('Industries', 'cuztom'),
                    'add_new_item' => __('Add New Industry', 'cuztom'),
                    'parent_item' => __('Parent Industry', 'cuztom'),
                ),
                'show_admin_column' => true,
                'admin_column_sortable' => true,
                'admin_column_filter' => true,
                'show_in_rest' => true,
            )
        );
        $box = register_cuztom_meta_box('data', WPREM_PROJECTS_CUSTOM_POST_TYPE,
            array(
                'title' => 'Project Information',
                'fields' => array(
                    array(
                        'id' => '_data_tabs',
                        'type' => 'tabs',
                        'panels' => $panels_arr,
                    ),
                ),
            )
        );
    }

}
