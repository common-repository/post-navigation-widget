<h3><?php Echo $this->t('Title') ?></h3>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('title_source') ?>" value="static" <?php Checked($this->get_option('title_source'), 'static') ?> />
<input type="text" name="<?php Echo $this->get_field_name('title') ?>" value="<?php Echo $this->get_option('title') ?>" />
</p>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('title_source') ?>" value="dynamic" <?php Checked($this->get_option('title_source'), 'dynamic') ?> />
<?php Echo $this->t('Title of the adjacent post.') ?>
</p>


<h3><?php Echo $this->t('Navigation direction') ?></h3>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('show_post') ?>" value="next" <?php Checked($this->get_option('show_post'), 'next'); Checked($this->get_option('show_post'), Null) ?> />
<?php Echo $this->t('Display the next post.') ?>
</p>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('show_post') ?>" value="prev" <?php Checked($this->get_option('show_post'), 'prev') ?> />
<?php Echo $this->t('Display the previous post.') ?>
</p>
<p>
<input type="checkbox" name="<?php Echo $this->get_field_name('same_category') ?>" value="yes" <?php Checked($this->get_option('same_category'), 'yes') ?> />
<?php Echo $this->t('Display only posts in the same category.') ?>
</p>



<h3><?php Echo $this->t('Display') ?></h3>
<p>
<input type="checkbox" name="<?php Echo $this->get_field_name('show_title') ?>" value="yes" <?php Checked($this->get_option('show_title'), 'yes') ?> />
<?php Echo $this->t('Display the post title.') ?>
</p>
<p>
<input type="checkbox" name="<?php Echo $this->get_field_name('show_date') ?>" value="yes" <?php Checked($this->get_option('show_date'), 'yes') ?> />
<?php Echo $this->t('Display the post date.') ?>
</p>
<p>
<input type="checkbox" name="<?php Echo $this->get_field_name('show_author') ?>" value="yes" <?php Checked($this->get_option('show_author'), 'yes') ?> />
<?php Echo $this->t('Display the post author.') ?>
</p>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('show_content') ?>" value="full_content" <?php Checked($this->get_option('show_content'), 'full_content') ?> />
<?php Echo $this->t('Display the full post content.') ?>
</p>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('show_content') ?>" value="excerpt" <?php Checked($this->get_option('show_content'), 'excerpt') ?> />
<?php Echo $this->t('Display the excerpt.') ?>
</p>
<p>
<input type="checkbox" name="<?php Echo $this->get_field_name('show_thumbnail') ?>" value="yes" <?php Checked($this->get_option('show_thumbnail'), 'yes') ?> />
<?php Echo $this->t('Display a thumbnail image.') ?>
</p>
<p>
<?php Echo $this->t('Thumbnail adjustment:') ?>
<select name="<?php Echo $this->get_field_name('thumb_adjustment') ?>">
  <option value="none" <?php Selected($this->get_option('thumb_adjustment'), 'none') ?>><?php Echo $this->t('None') ?></option>
  <option value="left" <?php Selected($this->get_option('thumb_adjustment'), 'left') ?>><?php Echo $this->t('Left') ?></option>
  <option value="right" <?php Selected($this->get_option('thumb_adjustment'), 'right') ?>><?php Echo $this->t('Right') ?></option>
</select>
</p>
<p>
<input type="radio" name="<?php Echo $this->get_field_name('show_content') ?>" value="none" <?php Checked($this->get_option('show_content'), 'none') ?> />
<?php Echo $this->t('Do not display any content.') ?>
</p>
<p>
<input type="checkbox" name="<?php Echo $this->get_field_name('show_more_link') ?>" value="yes" <?php Checked($this->get_option('show_more_link'), 'yes') ?> />
<?php Echo $this->t('Display a link to the post.') ?>
</p>


<h3><?php Echo $this->t('Exclude categories') ?></h3>
<p>
  <?php Echo $this->t('Here you can choose categories which should <strong>excluded</strong>:') ?><br />
  <?php ForEach((Array) get_categories() AS $category) : ?>
    <input type="checkbox" name="<?php Echo $this->get_field_name('exclude_category') ?>[]" value="<?php Echo $category->term_id ?>" <?php Checked((Array_Search($category->term_id, (Array) $this->get_option('exclude_category')) !== False)) ?> /> <?php Echo $category->name ?><br />
  <?php EndForEach; ?>
</p>
