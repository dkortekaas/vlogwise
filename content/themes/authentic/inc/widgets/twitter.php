<?php

/**
 * Twitter Widget
 */

//convert links to clickable format
if (!function_exists('authentic_convert_links')) {
  function authentic_convert_links($status,$targetBlank=true,$linkMaxLen=250){

    // the target
      $target=$targetBlank ? " target=\"_blank\" " : "";

    // convert link to url
      $status = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', '<a href="\0" target="_blank">\0</a>', $status);

    // convert @ to follow
      $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

    // convert # to search
      $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

    // return the status
      return $status;
  }
}

//convert dates to readable format
if (!function_exists('authentic_relative_time')) {
  function authentic_relative_time($a) {
    //get current timestampt
    $b = strtotime('now');
    //get timestamp when tweet created
    $c = strtotime($a);
    //get difference
    $d = $b - $c;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;

    if(is_numeric($d) && $d > 0) {
      //if less then 3 seconds
      if($d < 3) return esc_html__('right now','authentic');
      //if less then minute
      if($d < $minute) return floor($d) . esc_html__(' seconds ago','authentic');
      //if less then 2 minutes
      if($d < $minute * 2) return esc_html__('about 1 minute ago','authentic');
      //if less then hour
      if($d < $hour) return floor($d / $minute) . esc_html__(' minutes ago','authentic');
      //if less then 2 hours
      if($d < $hour * 2) return esc_html__('about 1 hour ago','authentic');
      //if less then day
      if($d < $day) return floor($d / $hour) . esc_html__(' hours ago','authentic');
      //if more then day, but less then 2 days
      if($d > $day && $d < $day * 2) return esc_html__('yesterday','authentic');
      //if less then year
      if($d < $day * 365) return floor($d / $day) . esc_html__(' days ago','authentic');
      //else return more than a year
      return esc_html__('over a year ago','authentic');
    }
  }
}

class authentic_widget_twitter extends WP_Widget {

  public function __construct() {
    $widget_details = array(
      'classname' => 'authentic_widget_twitter',
      'description' => esc_html__( 'Display Twitter Feed Widget.', 'authentic' )
    );
    parent::__construct( 'authentic_widget_twitter', esc_html__( 'Authentic: Twitter', 'authentic' ), $widget_details );
  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Twitter', 'authentic' );

    /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    echo $args['before_widget'];

    ?>

    <div class="widget-body">

    <?php if ( $title ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    $widget_id            = $args['widget_id'];

    $cache_time           = _get_field('cache_time', 'widget_' . $widget_id);
    $tweets_count         = _get_field('tweets_count', 'widget_' . $widget_id);
    $consumer_key         = _get_field('consumer_key', 'widget_' . $widget_id);
    $consumer_secret      = _get_field('consumer_secret', 'widget_' . $widget_id);
    $access_token         = _get_field('access_token', 'widget_' . $widget_id);
    $access_token_secret  = _get_field('access_token_secret', 'widget_' . $widget_id);

    // Check if all fields have been filled in

    if ( empty($consumer_key) || empty($consumer_key) || empty($access_token) || empty($access_token_secret) || empty($cache_time) ){

      echo '<div class="alert alert-warning">' . esc_html__('Unable to load tweets. Please fill in all required fields.','authentic') . '</div>';

    } else {

      // Check if transient already exists

      $tweets = get_transient( 'authentic_widget_twitter_tweets_' . $widget_id );

      if( !empty( $tweets ) ) {

        // Fetch tweets from the transient

        $tweets = maybe_unserialize($tweets);

      } else {

        // Check if CSCO: Twitter API plugin is installed

        if(!function_exists('get_tweets')) {

          echo '<div class="alert alert-warning">' . esc_html__('Unable to load tweets. Make sure CSCO: Twitter API plugin is installed and activated.', 'authentic') . '</div>';

        } else {

          // Get Tweets via Twitter OAuth

          $tweets = get_tweets($consumer_key, $consumer_secret, $access_token, $access_token_secret, array('count' => $tweets_count, 'include_rts' => false, 'exclude_replies' => true));

          // Check if errors have been returned

          if ( !empty($tweets) && isset($tweets->errors) ) {

            echo '<div class="alert alert-warning">' . $tweets->errors[0]->message . '</div>';

          } elseif ( !empty($tweets) && !isset($tweets->errors) ) {

            // Set a new transient if no errors returned

            set_transient( 'authentic_widget_twitter_tweets_' . $widget_id, maybe_serialize($tweets), $cache_time * 60 );

          }
        }
      }

      // Check if there're valid tweets

      if ( isset($tweets) && !empty($tweets) && !isset($tweets->errors) ) {

        echo '<div class="owl-container owl-flip">';
        echo '<div class="owl-carousel">';

        foreach($tweets as $tweet) {

          $text = authentic_convert_links($tweet->text);
          $screen_name = $tweet->user->screen_name;
          $retweets = $tweet->retweet_count;
          $retweets = $retweets > 0 ? $retweets : '';
          $tweet_id = $tweet->id_str;
          $time = authentic_relative_time($tweet->created_at);

          echo '<div class="owl-slide">';

          echo '<div class="tweet">' . $text . '</div>';

          ?>
          <ul class="twitter-actions">
            <li>
              <a onClick="window.open('https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet_id; ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-reply" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet_id; ?>">
                <i class="icon icon-reply"></i>
                <span><?php esc_html_e('Reply','authentic');?></span>
              </a>
            </li>
            <li>
              <a onClick="window.open('https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet_id; ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-retweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet_id; ?>">
                <i class="icon icon-repeat"></i> <?php echo $retweets; ?>
                <span><?php esc_html_e('Retweet','authentic');?></span>
              </a>
            </li>
            <li>
              <a onClick="window.open('https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet_id; ?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" class="tweet-favorite" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet_id; ?>">
                <i class="icon icon-heart"></i>
                <span><?php esc_html_e('Favorite','authentic');?></span>
              </a>
            </li>
          </ul>
          <?php

          echo '<p class="timestamp"><a href="https://twitter.com/' . $screen_name . '/status/' . $tweet_id . '" target="_blank">' . $time . '</a></p>';
          echo '</div>';

        }

        echo '</div>';
        echo '<div class="owl-dots"></div>';
        echo '</div>';

        echo '<a href="https://twitter.com/' . $screen_name .'/" class="btn btn-secondary btn-effect"><span>@' . $screen_name . '</span><span><i class="icon icon-twitter"></i> ' . esc_html__('Follow', 'authentic') . '</span></a>';

      }
    } ?>

    </div>

    <?php echo $args['after_widget'];

  }

  public function form( $instance ) {

    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

    ?>

    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'authentic' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <?php

    // Main fields are handled by ACF Pro
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    return $instance;
  }
}

if( function_exists('acf_add_local_field_group') ) {

  acf_add_local_field_group(array (
    'key' => 'group_widget_twitter',
    'title' => esc_html__('Twitter Widget Settings','authentic'),
    'fields' => array (
      array (
        'key' => 'field_twitter_tweets_count',
        'label' => esc_html__('Number of Tweets','authentic'),
        'name' => 'tweets_count',
        'type' => 'number',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 5,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_twitter_cache_time',
        'label' => esc_html__('Cache Time','authentic'),
        'name' => 'cache_time',
        'type' => 'number',
        'instructions' => esc_html__('Cache time in minutes.','authentic'),
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 30,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => '',
        'max' => '',
        'step' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_twitter_api_access',
        'label' => esc_html__('Twitter API Access','authentic'),
        'name' => '',
        'type' => 'message',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => __('Please create an app at <a href="https://dev.twitter.com/apps/" target="_blank">dev.twitter.com</a>, register access tokens and copy the credentials below.','authentic'),
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      array (
        'key' => 'field_twitter_consumer_key',
        'label' => esc_html__('Consumer Key','authentic'),
        'name' => 'consumer_key',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_twitter_consumer_secret',
        'label' => esc_html__('Consumer Secret','authentic'),
        'name' => 'consumer_secret',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_twitter_access_token',
        'label' => esc_html__('Access Token','authentic'),
        'name' => 'access_token',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_twitter_access_token_secret',
        'label' => esc_html__('Access Token Secret','authentic'),
        'name' => 'access_token_secret',
        'type' => 'text',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'widget',
          'operator' => '==',
          'value' => 'authentic_widget_twitter',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));

}
