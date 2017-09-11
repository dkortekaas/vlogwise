<?php

/**
 * Connect
 */

Kirki::add_section( 'connect', array(
  'title'          => esc_html__( 'Connect', 'authentic' ),
  'priority'       => 10,
));

Kirki::add_field( 'csco_option', array(
  'type'        => 'repeater',
  'label'       => esc_html__( 'Social Accounts', 'authentic' ),
  'section'     => 'connect',
  'priority'    => 10,
  'settings'    => 'csco_social_accounts',
  'default'     => array(),
  'fields' => array(
    'type' => array(
      'type'        => 'select',
      'default'     => 'facebook',
      'multiple'    => 0,
      'choices'     => csco_social_accounts(),
    ),
    'url' => array(
      'type'        => 'text',
      'label'       => esc_html__( 'Account URL', 'authentic' ),
      'default'     => '',
    ),
    'text' => array(
      'type'        => 'text',
      'label'       => esc_html__( 'Button Text', 'authentic' ),
      'default'     => '',
    ),
  ),
  'row_label' => array (
    'type' => 'field',
    'field' => 'type'
  ),
));

Kirki::add_field( 'csco_option', array(
  'type'        => 'toggle',
  'settings'    => 'csco_facebook_sdk',
  'label'       => esc_html__( 'Include Facebook SDK', 'authentic' ),
  'description' => esc_html__( 'Required for Facebook Page Widget.', 'authentic' ),
  'section'     => 'connect',
  'default'     => false,
  'priority'    => 10,
));

Kirki::add_field( 'csco_option', array(
  'type'        => 'text',
  'settings'    => 'csco_facebook_app_id',
  'label'       => esc_html__( 'Facebook App ID', 'authentic' ),
  'section'     => 'connect',
  'priority'    => 10,
  'active_callback' => array(
    array(
      'setting'  => 'csco_facebook_sdk',
      'operator' => '==',
      'value'    => true,
    ),
  ),
));

Kirki::add_field( 'csco_option', array(
  'type'        => 'text',
  'settings'    => 'csco_mailchimp_general_form_url',
  'label'       => esc_html__( 'MailChimp General Form URL', 'authentic' ),
  'section'     => 'connect',
  'default'     => '',
  'priority'    => 10,
));

Kirki::add_field( 'csco_option', array(
  'type'        => 'text',
  'settings'    => 'csco_mailchimp_embedded_form_url',
  'label'       => esc_html__( 'MailChimp Embedded Form URL', 'authentic' ),
  'section'     => 'connect',
  'default'     => '',
  'priority'    => 10,
));

