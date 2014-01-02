=== Ultimate WP Query Search Filter ===
Contributors: TC.K
Donate link: http://9-sec.com/donation/
Tags: Search Filter, taxonoy, custom post type, custom meta field, taxonomy & meta field filter, advanced search, Ajax, search engine
Requires at least: 3.5
Tested up to: 3.8
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Ultimate WP Query Search Filter let you search through post type, taxonomy and meta field. You can choose either search template or Ajax call to display the result. 

== Description ==

Ultimate WP Query Search Filter is a powerful search engine that let your user perform more precisely search by filtering the search through post type, taxonomy and meta field. The searched result can be displayed either through the theme search template or Ajax call. 

**Plugin Features:**

* Admin are free to choose whether the search go through post type, taxonomy, meta field or even all of them.
* Multiple Search Form Supported.
* Free to choose either theme search template or Ajax call to display the result for each of the search form.
* Search form support checkbox,radio and dropdown fields.
* Plugin extendable with hooks.
* Using shortcode to display the search form.


If you have any problems with current plugin, please leave a
message on Forums Posts or goto [Here](http://9-sec.com/support-forum/).


== Installation ==

1. Upload `ultimate-wp-query-search-filter` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create your search form in the Ultimate WPQSF menu.
4. Using `[ULWPQSF id={form id}]` to display the form. 

== Frequently Asked Questions ==

= How can I styling the search form? =

You can simply refer the themes/default.css that come with the folder and alter it or override it at your theme css file. 

= What if I want to display the search form in the template? =

Put this into `<?php echo do_shortcode("[ULWPQSF id={form id}"); ?>` your template.

= What if I want to display the search form in the sidebar widget? =

Just insert the shortcodes like you inserted in the post content. eg. '[ULWPQSF id=3299]`

= What is the 'button' parameter is used for ? And how to use it? =
The 'button' parameter is use to display/hide the button. NOTE that, this parameter only applied to AJAX SEARCH only and once you hide the button, it will automatically update the result when there is changes is made in the search form. To hide the button simply add 'button=0' to the shortcode. eg. '[ULWPQSF id=3299 button=0]' 

= What is the 'divclass' parameter is used for ? And how to use it? =
The 'divclass' is for adding your own class to the frontend search form. This class will be applied to each filter (taxonomy or meta field) and then you can use it for customize the design etc. To use the parameter, just simply add 'divclass' to the shortcode. eg. '[ULWPQSF id=3299 divclass=my_own_class]'

= What if I don't want to display the title of the search form? =

Just giving `0` to `formtitle` atribute in the shortcode eg. '[ULWPQSF id=3299 formtitle="0"]`

= How can I customize the plugin? =

You can goto this [website](http://9-sec.com/) to get the details.

For more Info or Documentation please visit [here](http://9-sec.com/2014/01/ultimate-wp-query-search-filter/).

== Screenshots ==
1. Ultimate WP Query Search Filter setting page 1
2. Ultimate WP Query Search Filter setting page 2
2. Ultimate WP Query Search Filter setting page 3
4. Ultimate WP Query Search Filter setting page 4
5. Ultimate WP Query Search Filter search form in the content and sidebar


== Changelog ==


= 1.0.0 =
* First version released.

= 1.0.2 =
* Fix header message sent error.

