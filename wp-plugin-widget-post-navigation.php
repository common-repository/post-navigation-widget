<?php

/*

Plugin Name: Post Navigation Widget
Description: You can use this Widget to show the next or previous post link on single post views.
Plugin URI: http://dennishoppe.de/wordpress-plugins/post-navigation-widget
Version: 1.2.4
Author: Dennis Hoppe
Author URI: http://DennisHoppe.de

*/


If (!Class_Exists('wp_widget_post_navigation')){
Class wp_widget_post_navigation Extends WP_Widget {
  var $arr_option;
  var $base_url;
  
  Function __construct(){
    // Get ready to translate
    $this->Load_TextDomain();

    // Setup the Widget data
    parent::__construct (
      False,
      $this->t('Post Navigation'),
      Array('description' => $this->t('You can use this Widget to show the next or previous post link on single post views.'))
    );

    // Read base_url
    $this->base_url = get_bloginfo('wpurl').'/'.Str_Replace("\\", '/', SubStr(RealPath(DirName(__FILE__)), Strlen(ABSPATH)));

    // Hooks
    Add_Action ('wp_print_styles', Array($this, 'add_widget_style'));      
  }
  
  Function Load_TextDomain(){
    $locale = Apply_Filters( 'plugin_locale', get_locale(), __CLASS__ );
    Load_TextDomain (__CLASS__, DirName(__FILE__).'/language/' . $locale . '.mo');
  }
  
  Function t ($text, $context = ''){
    // Translates the string $text with context $context
    If ($context == '')
      return Translate ($text, __CLASS__);
    Else
      return Translate_With_GetText_Context ($text, $context, __CLASS__);
  }
  
  Function default_options(){
    return Array(
      'same_category'     => False,
      'exclude_category'  => Array(),
      'show_post'         => 'next',
      'title_source'      => 'static',
      'title'             => $this->t('Post Navigation'),
      'show_more_link'    => False,
      'show_content'      => 'excerpt',
      'show_thumbnail'    => False,
      'thumb_adjustment'  => 'left'
    );
  }

  Function load_options($options){
    $options = (ARRAY) $options;
    
    // Delete empty values
    ForEach ($options AS $key => $value)
      If (!$value) Unset($options[$key]);
    
    // Load options
    $this->arr_option = Array_Merge ($this->default_options(), $options);
  }
  
  Function get_option($key, $default = False){
    If (IsSet($this->arr_option[$key]) && $this->arr_option[$key])
      return $this->arr_option[$key];
    Else
      return $default;
  }
  
  Function set_option($key, $value){
    $this->arr_option[$key] = $value;
  }

  Function add_widget_style(){
    If (Is_File(get_stylesheet_directory() . '/post-navigation-widget.css'))
      $style_sheet = get_stylesheet_directory_uri() . '/post-navigation-widget.css';
    ElseIf (Is_File(DirName(__FILE__) . '/post-navigation-widget.css'))
      $style_sheet = $this->base_url . '/post-navigation-widget.css';
    
    // run the filter for the template file
    $style_sheet = Apply_Filters('post_navigation_widget_style_sheet', $style_sheet);
    
    If ($style_sheet) WP_Enqueue_Style('post-navigation-widget-style', $style_sheet);
  }
  
  Function widget ($widget_args, $options){
    // Load options
    $this->Load_Options($options); Unset($options);
    
    // This is dirty :( But we have to give the function a part of a sql statement.
    $exclude_category = Implode (' AND ', (Array) $this->get_option('exclude_category'));
    
    // Find the post we want to show
    If ($this->get_option('show_post') == 'next'){
      // Try to find the next post
      If ($adjacent_post = get_next_post($this->get_option('same_category'), $exclude_category)){
        $GLOBALS['post'] = $adjacent_post;
        Setup_PostData ($GLOBALS['post']);
      }
      Else
        return False;
    }
    ElseIf ($this->get_option('show_post') == 'prev'){
      // Try to find the previous post
      If ($adjacent_post = get_previous_post($this->get_option('same_category'), $exclude_category)){
        $GLOBALS['post'] = $adjacent_post;
        Setup_PostData ($GLOBALS['post']);
      }
      Else
        return False;
    }
    Else {
      // Here we can't do anymore
      return False;
    }
    
    // Look for the template file
    $template_name = 'post-navigation-widget.php';
    $template_file = Get_Query_Template(BaseName($template_name, '.php'));
    If (!Is_File($template_file) && Is_File(DirName(__FILE__) . '/' . $template_name))
      $template_file = DirName(__FILE__) . '/' . $template_name;
    
    // run the filter for the template file
    $template_file = Apply_Filters('post_navigation_widget_template', $template_file);
    
    // Build Widget title
    If ( $this->get_option('title_source') == 'dynamic' ) $this->set_option('title', get_the_title());
    $this->set_option('widget_title', $widget_args['before_title'] . $this->get_option('title') . $widget_args['after_title']  );
    
    // Print the widet
    If ($template_file && Is_File ($template_file)){
      Echo $widget_args['before_widget'];
      Include $template_file;
      Echo $widget_args['after_widget'];
    }
    
    // Reset the global post var
    WP_Reset_PostData();
  }
 
  Function form ($options){
    $this->Load_Options($options); Unset($options);
    Include DirName(__FILE__) . '/form.php';
  }
  
  Function get_post_thumbnail($post_id = Null, $size = 'thumbnail'){
    /* Return Value: An array containing:
         $image[0] => attachment id
         $image[1] => url
         $image[2] => width
         $image[3] => height
    */
    If ($post_id == Null) $post_id = get_the_id();
    
    If (Function_Exists('get_post_thumbnail_id') && $thumb_id = get_post_thumbnail_id($post_id) )
      return Array_Merge ( Array($thumb_id), (Array) wp_get_attachment_image_src($thumb_id, $size) );
    ElseIf ($arr_thumb = self::get_post_attached_image($post_id, 1, 'rand', $size))
      return $arr_thumb[0];
    Else
      return False;
  }

  Function get_post_attached_image($post_id = Null, $number = 1, $orderby = 'rand', $image_size = 'thumbnail'){
    If ($post_id == Null) $post_id = get_the_id();
    $number = IntVal ($number);
    $arr_attachment = get_posts (Array( 'post_parent'    => $post_id,
                                        'post_type'      => 'attachment',
                                        'numberposts'    => $number,
                                        'post_mime_type' => 'image',
                                        'orderby'        => $orderby ));
    
    // Check if there are attachments
    If (Empty($arr_attachment)) return False;
    
    // Convert the attachment objects to urls
    ForEach ($arr_attachment AS $index => $attachment){
      $arr_attachment[$index] = Array_Merge ( Array($attachment->ID), (Array) wp_get_attachment_image_src($attachment->ID, $image_size));
      /* Return Value: An array containing:
           $image[0] => attachment id
           $image[1] => url
           $image[2] => width
           $image[3] => height
      */
    }
    
    return $arr_attachment;
  }

  
} /* End of Class */
Add_Action ('widgets_init', Create_Function ('','Register_Widget(\'wp_widget_post_navigation\');') );
Require_Once DirName(__FILE__).'/contribution.php';
} /* End of If-Class-Exists-Condition */
/* End of File */