(function($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    class ProjectSettings {
        constructor(id, arg) {
            this.id = id
            this.arg = arg
            if (!document.getElementById(this.id))
                return false
            this.inputtype = document.getElementById(this.id)
            if (this.inputtype.type == 'checkbox' && !this.inputtype.checked)
            	return false
        	
        	this.val = document.getElementById(this.id).value
        }

        get set() {
            if (this.val)
                return " " + this.go();
            else
                return "";
        }

        go() {
            return this.arg + '="' + this.val + '"';
        }
    }

    $(document).on("click", "#project-insert", function() {
        project_container();
    });

    function project_container() {
    	const margins = new ProjectSettings('wp_margins', 'margin');
        const cols = new ProjectSettings('wp_cols', 'columns');
        const auto = new ProjectSettings('wp_auto', 'auto');
        const captions = new ProjectSettings('wp_captions', 'captions');
        const link = new ProjectSettings('wp_link', 'link');
        const pagination = new ProjectSettings('wp_pagination', 'dots');
        window.send_to_editor("[wp_projects" + margins.set + cols.set + auto.set + captions.set + link.set + pagination.set +"]");
    }

})(jQuery);