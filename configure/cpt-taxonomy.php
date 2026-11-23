<?php

// Custom Post types
include( __DIR__ . '/cpt-test-items.php' );

/**
 * Custom Post Type: Projekte (Tischlerei Gruber)
 * Jedes Projekt = ein Eintrag. URL: /projekte/projektname/
 * Die Seite "Projekte" listet alle Einträge über das Modul "Project List".
 */
add_action( 'init', 'projecttheme_register_projekte' );

function projecttheme_register_projekte() {

    $labels = array(
        'name'               => _x( 'Projekte', 'Post type general name', 'projecttheme' ),
        'singular_name'      => _x( 'Projekt', 'Post type singular name', 'projecttheme' ),
        'menu_name'          => _x( 'Projekte', 'Admin Menu text', 'projecttheme' ),
        'name_admin_bar'     => _x( 'Projekt', 'Add New on Toolbar', 'projecttheme' ),
        'add_new'            => __( 'Neues Projekt', 'projecttheme' ),
        'add_new_item'       => __( 'Neues Projekt hinzufügen', 'projecttheme' ),
        'new_item'           => __( 'Neues Projekt', 'projecttheme' ),
        'edit_item'          => __( 'Projekt bearbeiten', 'projecttheme' ),
        'view_item'          => __( 'Projekt ansehen', 'projecttheme' ),
        'all_items'          => __( 'Alle Projekte', 'projecttheme' ),
        'search_items'       => __( 'Projekte durchsuchen', 'projecttheme' ),
        'not_found'          => __( 'Keine Projekte gefunden.', 'projecttheme' ),
        'not_found_in_trash' => __( 'Keine Projekte im Papierkorb.', 'projecttheme' ),
        'featured_image'     => __( 'Titelbild', 'projecttheme' ),
        'set_featured_image' => __( 'Titelbild festlegen', 'projecttheme' ),
    );

    register_post_type( 'projekt', array(
        'labels'        => $labels,
        'public'        => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-hammer',
        'menu_position' => 20,
        'has_archive'   => false,            // Übersicht = Seite "Projekte" mit Modul "Project List"
        'rewrite'       => array( 'slug' => 'projekte', 'with_front' => false ),
        'supports'      => array( 'title', 'thumbnail', 'excerpt', 'page-attributes' ),
    ) );
}

// Taxonomies

/**
 * Taxonomie: Projektkategorie (Büro, Praxis, Wohnen, Küche …)
 */
add_action( 'init', 'projecttheme_register_projektkategorie' );

function projecttheme_register_projektkategorie() {
    register_taxonomy( 'projektkategorie', array( 'projekt' ), array(
        'labels'            => array(
            'name'          => __( 'Kategorien', 'projecttheme' ),
            'singular_name' => __( 'Kategorie', 'projecttheme' ),
            'add_new_item'  => __( 'Neue Kategorie', 'projecttheme' ),
        ),
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'projektkategorie' ),
    ) );
}

/**
 * Projekte nach "Reihenfolge" (Seitenattribute) und Datum sortieren
 */
add_action( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }
    if ( 'projekt' === $query->get( 'post_type' ) && ! $query->get( 'orderby' ) ) {
        $query->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'DESC' ) );
    }
} );

/**
 * Permalinks nach dem ersten Laden des neuen Post Types einmal neu schreiben
 */
add_action( 'init', function () {
    if ( get_option( 'projecttheme_projekte_flushed' ) !== '1' ) {
        flush_rewrite_rules( false );
        update_option( 'projecttheme_projekte_flushed', '1' );
    }
}, 99 );
