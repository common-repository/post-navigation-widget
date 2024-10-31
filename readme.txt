=== Post Navigation Widget ===
Contributors: dhoppe
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=1220480
Tags: post, posts, navigation, widget, admin, widgets, next, previous
Requires at least: 3.0
Tested up to: 3.3
Stable tag: trunk

The Post Navigation Widget implements a post navigation which enables the user to go to the next or previous post.

== Description ==

= Description =
This Widget shows an adjacent post of the current one. You can choose which properties of the post should be shown. The default template supports the post title, author, date, excerpt, full content and thumbnail. Of course you can create your own customized template (or hire me for that) which fits your theme perfectly. Learn more about that below...


= Usage =
You should use it on widget areas on single post views only.


= Requirements =
* **PHP5!**
* WordPress 3.0 or higher


= Handling =
The handling is very easy. After activating the plug-in you will find a new widget in your admin panel. Add it to a sidebar and check all options you need. That's it.


= It doesn't work! =
If you are wondering why there is no new widget in your admin panel after activating the plug-in i guess you aren't using PHP5. **This widget requires PHP5!**


= Customizing the appearance =
**This plug-in does not contain any style information!** If you want to customize the design you have to do the following:

* copy the *post-navigation-widget.css* file (from the plug-in folder) to your theme directory
* copy the *post-navigation-widget.php* file (from the plug-in folder) to your theme directory
* Now you can start customize the style of your widget until it fits your needs. Both files are well documented and easy to understand. The *post-navigation-widget.php* builds the architecture. The *post-navigation-widget.css* adds the style information. 

**Of course i can help you customizing your widget appearance** for a small fee. ;) Feel free to send me a mail or leave a comment in my blog.


= For developers =
If you want to use a customized template file outside the theme directory you can use the *post_navigation_widget_template* filter. Just write a path to a file in the filter to bypass the template. Here is an example that shows how you can write a plugin which changes the template path to a file in the same directory.

<code>
Function bypass_template($template_file){
  /* the $template_file is the file which is currently set as template so
     you can also use the filter to read the current template file. 
  */
  return DirName(__FILE__) . '/my-template.php'; // This has to be a local file path!
}
Add_Filter('post_navigation_widget_template', 'bypass_template');
</code>

Analogical you can change the style sheet with the *post_navigation_widget_style_sheet* filter. Here is an example:
<code>
Function bypass_style_sheet($css_file){
  /* the $css_file is the file (URL) which is currently set as style sheet so
     you can also use the filter to read the current css file. 
  */
  // Url to your CSS File
  return get_bloginfo('wpurl') . '/my-style.css'; // This has to be an URL!
}
Add_Filter('author_info_widget_style_sheet', 'bypass_style_sheet');
</code>


= Language =
* This plug-in is available in English.
* Dieses Plugin ist in Deutsch verfügbar. ([Dennis Hoppe](http://dennishoppe.de/))
* Acest plugin este disponibil în limba Română. ([Anunturi Jibo](http://www.jibo.ro/))
* Bu eklentinin Türkçe desteği bulunmaktadır. ([Ramerta Grup](http://ramerta.com/))

If you have translated this plug-in in your language feel free to send me the language file (.po file) via E-Mail with your name and this translated sentence: "This plug-in is available in %YOUR_LANGUAGE_NAME%." So i can add it to the plug-in.

You can find the *Translation.pot* file in the *language/* folder in the plug-in directory.

* Copy it.
* Rename it (to your language code).
* Translate everything.
* Send it via E-Mail to mail@DennisHoppe.de.
* Thats it. Thank you! =)


= Questions =
If you have any questions feel free to leave a comment in my blog. But please think about this: I will not add features, write customizations or write tutorials for free. Please think about a donation. I'm a human and to write code is hard work.


== Screenshots ==

1. The Post Navigation Widget Back-End. 
2. The Post Navigation Widget Front-End in Twenty-Ten (WP3).


== Installation ==

Installation as usual.

1. Unzip and Upload all files to a sub directory in "/wp-content/plugins/".
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to Widgets and add the new Widget to a sidebar which will be shown on posts.
1. You like what you see?

== Changelog ==

= 1.2.4 =
* Added Turkish translation by [Ramerta Grup](http://ramerta.com/).

= 1.2.3 =
* Cleaned up code.
* Added Romanian translation by [Anunturi Jibo](http://www.jibo.ro/).

= 1.2.2 =
* Fixed hard encoded style links
* Updated donation plugin

= 1.2.1 =
* Fixed: Multiple usage of the widget in the one sidebar
* Fixed language file (German)
* Fixed: post date appearance when there are more posts from the same day
* Added 'plugin_locale' Filter support

= 1.2 =
* Added template engine and filters for the template and style sheet

= 1.1.3 =
* Fixed a bug in the exclude algorithm

= 1.1.2 =
* Post thumbnails are linking to the adjacent post

= 1.1.1 =
* You can set the title for the widget
* You can change the previous/next link captions
* Now you can decide if the excerpt should be visible
* Added thumbnail support

= 1.1 =
* New Feature: You can choose if the widget should only show posts from the same category
* New Feature: You can exclude categories

= 1.0 =
* Everything works fine.