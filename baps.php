<?php
/**
 * Plugin Name: BEST Application System
 * Description: Application System for beWANTED and CO
 * Version: 0.1
 * Author: Franz Papst
 * Author URI: http://www.bestvienna.at
 * License: MIT
 */

require("baps-admin.php");
require("baps-ui.php");

add_action("admin_menu", "baps_menu");
add_action('init', 'baps_init');

function baps_menu() {
    add_menu_page("BEST Application System", "BEST Application System", "publish_posts", "baps-admin", "baps_admin_page");
    add_submenu_page("baps-admin", "Export CVs", "Export CVs", "activate_plugins", "baps_export", "baps_export_page");
    add_submenu_page("baps-admin", "Settings", "Settings", "activate_plugins", "baps_settings", "baps_settings_page");
// add_submenu_page("applications", "Settings", "Settings", "activate_plugins", "applications_settings", "aps_settings_page");
// add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null )
// add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
}

function baps_init() {
}

function baps_activation() {
  global $wpdb;
  $wp = $wpdb->prefix;

  /*
INSERT INTO `wp_baps_companies` (`id`, `name`) VALUES 
(NULL, 'Prodyna'), (NULL, 'PwC'), (NULL, 'DXC'), (NULL, 'BRZ'), (NULL, 'Bosch'), (NULL, 'Deloitte'), (NULL, 'APG')
  */

  /*
INSERT INTO `wp_baps_timeslots_companies` (`id`, `company_id`, `timeslot_id`) VALUES  
(NULL, '1', '1'), (NULL, '1', '2'), (NULL, '1', '3'), (NULL, '1', '4'), (NULL, '1', '5'), (NULL, '1', '6'),
(NULL, '1', '7'), (NULL, '1', '8'), (NULL, '1', '9'), (NULL, '1', '10'), (NULL, '1', '11'), (NULL, '1', '12'), (NULL, '1', '13'),
(NULL, '2', '1'), (NULL, '2', '2'), (NULL, '2', '3'), (NULL, '2', '4'), (NULL, '2', '5'), (NULL, '2', '6'),
(NULL, '2', '7'), (NULL, '2', '8'), (NULL, '2', '9'), (NULL, '2', '10'), (NULL, '2', '11'), (NULL, '2', '12'), (NULL, '2', '13'),
(NULL, '3', '1'), (NULL, '3', '2'), (NULL, '3', '3'), (NULL, '3', '4'), (NULL, '3', '5'), (NULL, '3', '6'),
(NULL, '3', '7'), (NULL, '3', '8'), (NULL, '3', '9'), (NULL, '3', '10'), (NULL, '3', '11'), (NULL, '3', '12'), (NULL, '3', '13'),
(NULL, '4', '1'), (NULL, '4', '2'), (NULL, '4', '3'), (NULL, '4', '4'), (NULL, '4', '5'), (NULL, '4', '6'), 
(NULL, '4', '7'), (NULL, '4', '8'), (NULL, '4', '9'), (NULL, '4', '10'), (NULL, '4', '11'), (NULL, '4', '12'), (NULL, '4', '13'),
(NULL, '5', '1'), (NULL, '5', '2'), (NULL, '5', '3'), (NULL, '5', '4'), (NULL, '5', '5'), (NULL, '5', '6'), (NULL, '5', '7'),
(NULL, '6', '1'), (NULL, '6', '2'), (NULL, '6', '3'), (NULL, '6', '4'), (NULL, '6', '5'), (NULL, '6', '6'), (NULL, '6', '7'),
(NULL, '7', '8'), (NULL, '7', '9'), (NULL, '7', '10'), (NULL, '7', '11'), (NULL, '7', '12'), (NULL, '7', '13')
  */

  /*
INSERT INTO `wp_baps_study_fields` (`id`, `name`) VALUES 
(NULL, 'Architektur'), (NULL, 'Bauingenieurwesen'), (NULL, 'Biomedical Engineering'), (NULL, 'Computational Science and Engineering'),
(NULL, 'Elektrotechnik'), (NULL, 'Geodäsie und Geoinformation'), (NULL, 'Informatik'), (NULL, 'Maschinenbau'), 
(NULL, 'Materialwissenschaften'), (NULL, 'Raumplanung und Raumordnung'), (NULL, 'Technische Mathematik'),
(NULL, 'Technische Physik'), (NULL, 'Umweltingenieurwesen'), (NULL, 'Verfahrenstechnik'), (NULL, 'Wirtschaftsingenieurwesen - Maschinenbau')
  */

  /*
INSERT INTO `wp_baps_timeslots` (`id`, `slot`) VALUES
(NULL, '09:00'), (NULL, '09:30'), (NULL, '10:00'), (NULL, '10:30'), (NULL, '11:00'), (NULL, '11:30'), (NULL, '12:00'), (NULL, '13:30'),
(NULL, '14:00'), (NULL, '14:30'), (NULL, '15:00'), (NULL, '15:30'), (NULL, '16:00'), (NULL, '16:30')
  */
  
  $query = "CREATE TABLE IF NOT EXISTS`{$wp}baps_companies` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255),
      PRIMARY KEY (`id`),
      UNIQUE (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";
  $wpdb->query($query);

  $query = "CREATE TABLE IF NOT EXISTS`{$wp}baps_timeslots` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `slot` varchar(30),
      PRIMARY KEY (`id`),
      UNIQUE (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";
  $wpdb->query($query);

  $query = "CREATE TABLE `{$wp}baps_timeslots_companies` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `company_id` int(11),
    `timeslot_id` int(11),
    UNIQUE (id),
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";
  $wpdb->query($query);

  $query = "CREATE TABLE IF NOT EXISTS `{$wp}baps_study_fields` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `field` varchar(255),
    UNIQUE (id),
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";
  $wpdb->query($query);

  $query = "CREATE TABLE IF NOT EXISTS`{$wp}baps_applicants` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255),
    `email` varchar(255),
    `student_id` varchar(255),
    `uuid` varchar(50),
    `study_field` int(11),
    `semester` varchar(10),
    PRIMARY KEY (`id`),
    UNIQUE (id, uuid),
    CONSTRAINT fk_study_field FOREIGN KEY (study_field) REFERENCES {$wp}baps_study_fields(id) ON UPDATE CASCADE ON DELETE RESTRICT
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";
  $wpdb->query($query);

  $query = "CREATE TABLE IF NOT EXISTS `{$wp}baps_timeslots_applicants` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `applicant_id` int(11),
      `company_id` int(11),
      `timeslot_id` int(11),
      `timestamp` timestamp,
      UNIQUE (id),
      PRIMARY KEY (`id`),
      CONSTRAINT fk_applicant_id FOREIGN KEY (applicant_id) REFERENCES {$wp}baps_applicants(id) ON UPDATE CASCADE ON DELETE RESTRICT,
      CONSTRAINT fk_company_id FOREIGN KEY (company_id) REFERENCES {$wp}baps_companies(id) ON UPDATE CASCADE ON DELETE RESTRICT,
      CONSTRAINT fk_timeslot FOREIGN KEY (timeslot_id) REFERENCES {$wp}baps_timeslots(id) ON UPDATE CASCADE ON DELETE RESTRICT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;";
    echo($query);
    $wpdb->query($query);

    $query = "INSERT INTO {$wp}baps_study_fields (id, field) VALUES 
      (NULL, 'Architektur'), 
      (NULL, 'Bauingenieurwesen'), 
      (NULL, 'Biomedical Engineering'), 
      (NULL, 'Computational Science and Engineering'), 
      (NULL, 'Elektrotechnik'), 
      (NULL, 'Geodäsie und Geoinformation'), 
      (NULL, 'Informatik'), 
      (NULL, 'Maschinenbau'), 
      (NULL, 'Materialwissenschaften'), 
      (NULL, 'Raumplanung und Raumordnung'), 
      (NULL, 'Technische Mathematik'), 
      (NULL, 'Technische Physik'), 
      (NULL, 'Umweltingenieurwesen'), 
      (NULL, 'Verfahrenstechnik'), 
      (NULL, 'Wirtschaftsingenieurwesen - Maschinenbau'),
      (NULL, 'Sonstige')";
    $wpdb->query($query);

// TODO: diese 3 INSERTs nicht hardcoden sondern sachen im Backend dafür schreiben
    $query = "INSERT IGNORE INTO {$wp}baps_companies (id, name) VALUES 
      (NULL, 'Prodyna'), (NULL, 'PwC'), (NULL, 'DXC'), (NULL, 'BRZ'), (NULL, 'Deloitte')";
    $wpdb->query($query);

    $query = "INSERT IGNORE INTO {$wp}baps_timeslots (`id`, `slot`) VALUES
      (NULL, 'Mo. 15.6. 08:30'),
      (NULL, 'Mo. 15.6. 09:00'),
      (NULL, 'Mo. 15.6. 09:30'),
      (NULL, 'Mo. 15.6. 10:00'),
      (NULL, 'Mo. 15.6. 10:30'),
      (NULL, 'Mo. 15.6. 11:00'),
      (NULL, 'Mo. 15.6. 13:30'),
      (NULL, 'Mo. 15.6. 14:00'),
      (NULL, 'Mo. 15.6. 14:30'),
      (NULL, 'Mo. 15.6. 15:00'),
      (NULL, 'Mo. 15.6. 15:30'),
      (NULL, 'Mo. 15.6. 16:00'),
      (NULL, 'Di. 16.6. 08:30'),
      (NULL, 'Di. 16.6. 09:00'),
      (NULL, 'Di. 16.6. 09:30'),
      (NULL, 'Di. 16.6. 10:00'),
      (NULL, 'Di. 16.6. 10:30'),
      (NULL, 'Di. 16.6. 11:00'),
      (NULL, 'Di. 16.6. 11:30'),
      (NULL, 'Di. 16.6. 13:30'),
      (NULL, 'Di. 16.6. 14:00'),
      (NULL, 'Di. 16.6. 14:30'),
      (NULL, 'Di. 16.6. 15:00'),
      (NULL, 'Di. 16.6. 15:30'),
      (NULL, 'Di. 16.6. 16:00'),
      (NULL, 'Mi. 17.6. 08:30'),
      (NULL, 'Mi. 17.6. 09:00'),
      (NULL, 'Mi. 17.6. 09:30'),
      (NULL, 'Mi. 17.6. 10:00'),
      (NULL, 'Mi. 17.6. 10:30'),
      (NULL, 'Mi. 17.6. 11:00'),
      (NULL, 'Mi. 17.6. 13:30'),
      (NULL, 'Mi. 17.6. 14:00'),
      (NULL, 'Mi. 17.6. 14:30'),
      (NULL, 'Mi. 17.6. 15:00'),
      (NULL, 'Mi. 17.6. 15:30'),
      (NULL, 'Mi. 17.6. 16:00'),
      (NULL, 'Do. 18.6. 08:30'),
      (NULL, 'Do. 18.6. 09:00'),
      (NULL, 'Do. 18.6. 09:30'),
      (NULL, 'Do. 18.6. 10:00'),
      (NULL, 'Do. 18.6. 10:30'),
      (NULL, 'Do. 18.6. 11:00'),
      (NULL, 'Do. 18.6. 13:30'),
      (NULL, 'Do. 18.6. 14:00'),
      (NULL, 'Do. 18.6. 14:30'),
      (NULL, 'Do. 18.6. 15:00'),
      (NULL, 'Do. 18.6. 15:30'),
      (NULL, 'Do. 18.6. 16:00'),
      (NULL, 'Fr. 19.6. 08:30'),
      (NULL, 'Fr. 19.6. 09:00'),
      (NULL, 'Fr. 19.6. 09:30'),
      (NULL, 'Fr. 19.6. 10:00'),
      (NULL, 'Fr. 19.6. 10:30'),
      (NULL, 'Fr. 19.6. 11:00'),
      (NULL, 'Fr. 19.6. 13:30'),
      (NULL, 'Fr. 19.6. 14:00'),
      (NULL, 'Fr. 19.6. 14:30'),
      (NULL, 'Fr. 19.6. 15:00'),
      (NULL, 'Fr. 19.6. 15:30'),
      (NULL, 'Fr. 19.6. 16:00')";
    $wpdb->query($query);


    $query = "SELECT id, name FROM {$wp}baps_companies";
    $wpdb->query($query);
    $companies = $wpdb->get_results($query);
    foreach ($companies as $c) {
        if ($c->name == 'Deloitte')
            $query = "SELECT id FROM {$wp}baps_timeslots WHERE `slot` IN ('Di. 16.6. 08:30', 'Di. 16.6. 09:00', 'Di. 16.6. 09:30', 'Mi. 17.6. 08:30', 'Mi. 17.6. 09:00', 'Mi. 17.6. 09:30')";
        elseif ($c->name == 'PwC')
            $query = "SELECT id FROM {$wp}baps_timeslots WHERE `slot` IN ('Mo. 15.6. 13:30', 'Mo. 15.6. 14:00', 'Mo. 15.6. 14:30', 'Di. 16.6. 13:30', 'Di. 16.6. 14:00', 'Di. 16.6. 14:30')";
        elseif ($c->name == 'Prodyna')
            $query = "SELECT id FROM {$wp}baps_timeslots WHERE `slot` IN ('Di. 16.6. 08:30', 'Di. 16.6. 09:00', 'Di. 16.6. 09:30', 'Di. 16.6. 10:00', 'Di. 16.6. 10:30', 'Di. 16.6. 11:00')";
        elseif ($c->name == 'DXC')
            $query = "SELECT id FROM {$wp}baps_timeslots WHERE `slot` IN ('Di. 16.6. 10:00', 'Di. 16.6. 10:30', 'Di. 16.6. 11:00', 'Di. 16.6. 11:30', 'Mi. 17.6. 13:30', 'Mi. 17.6. 14:00', 'Mi. 17.6. 14:30', 'Mi. 17.6. 15:00', 'Do. 18.6. 13:30', 'Do. 18.6. 14:00', 'Do. 18.6. 14:30', 'Do. 18.6. 15:00')"; 
        elseif ($c->name == 'BRZ')
            $query = "SELECT id FROM {$wp}baps_timeslots WHERE `slot` IN ('Mo. 15.6. 08:30', 'Mo. 15.6. 09:00', 'Mo. 15.6. 09:30', 'Di. 16.6. 08:30', 'Di. 16.6. 09:00', 'Di. 16.6. 09:30', 'Mi. 17.6. 08:30', 'Mi. 17.6. 09:00', 'Mi. 17.6. 09:30', 'Do. 18.6. 08:30', 'Do. 18.6. 09:00', 'Do. 18.6. 09:30')";
        $slots = $wpdb->get_results($query);
        $query2 = "INSERT INTO {$wp}baps_timeslots_companies (id, company_id, timeslot_id) VALUES ";
        foreach ($slots as $s) {
            $query2 = $query2.sprintf('(NULL, "%d", "%d"),', $c->id, $s->id);
        }
        $query2 = substr($query2, 0, -1);
        $wpdb->query($query2);
    }

    if (!is_dir(BAPS_UPLOAD_DIR)) {
        mkdir(BAPS_UPLOAD_DIR);
    }
}

function baps_deactivation() {
}

register_activation_hook(__FILE__, 'baps_activation');
register_deactivation_hook(__FILE__, 'baps_deactivation');

?>