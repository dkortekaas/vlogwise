<?php

// Projects
add_action('init', 'authentic_projects');
function authentic_projects() {

    register_taxonomy(
        'project_type',
        'project',
        array(
            'label'          => __( 'Project Types', 'authentic' ),
            'singular_label' => __( 'Project Type', 'authentic' ),
            'hierarchical'   => true,
            'query_var'      => true,
            'rewrite'        => array('slug' => 'projects'),
      )
   );

    $labels = array(
        'name'                => _x( 'Project', 'Post Type General Name', 'authentic' ),
        'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'authentic' ),
        'menu_name'           => __( 'Projects', 'authentic' ),
        'all_items'           => __( 'All Projects', 'authentic' ),
        'view_item'           => __( 'View Project', 'authentic' ),
        'add_new_item'        => __( 'Add New Project', 'authentic' ),
        'add_new'             => __( 'Add New', 'authentic' ),
        'edit_item'           => __( 'Edit Project', 'authentic' ),
        'update_item'         => __( 'Update Project', 'authentic' ),
        'search_items'        => __( 'Search Project', 'authentic' )
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title','editor', 'thumbnail','author'),
        'rewrite'               => array(
            'slug'              => 'project',
            'with_front'        => false
        ),
        'has_archive'           => 'project',
        'menu_icon'             => 'dashicons-portfolio',
        'taxonomies'            => array('tag')
    );

    register_post_type( 'project' , $args );
    flush_rewrite_rules();
}

add_action('save_post', 'save_details');


// Tags
function create_tag_taxonomies() {
    $labels = array(
        'name' => _x( 'Tags', 'taxonomy general name' ),
        'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Tags' ),
        'popular_items' => __( 'Popular Tags' ),
        'all_items' => __( 'All Tags' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Tag' ), 
        'update_item' => __( 'Update Tag' ),
        'add_new_item' => __( 'Add New Tag' ),
        'new_item_name' => __( 'New Tag Name' ),
        'separate_items_with_commas' => __( 'Separate tags with commas' ),
        'add_or_remove_items' => __( 'Add or remove tags' ),
        'choose_from_most_used' => __( 'Choose from the most used tags' ),
        'menu_name' => __( 'Tags' ),
    ); 

    register_taxonomy('tag','project',array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'tag' ),
    ));
}
add_action( 'init', 'create_tag_taxonomies', 0 );

?>