<?php

/**
 * Custom Search
 *
 * @link       http://thepixeltribe.com
 * @since      1.0.0
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pt_Real_Estate_Proffesional
 * @subpackage Pt_Real_Estate_Proffesional/admin
 * @author     Pixel Tribe <support@thepixeltribe.com>
 */


class WPSE_OR_Query extends WP_Query 
{       
    protected $meta_or_tax  = FALSE;
    protected $tax_args     = NULL;
    protected $meta_args    = NULL;

    public function __construct( $args = array() )
    {
        add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 10 );
        add_filter( 'posts_clauses', array( $this, 'posts_clauses' ), 10 );
        parent::__construct( $args );
    }

    public function pre_get_posts( $qry )
    {       
        remove_action( current_filter(), array( $this, __FUNCTION__ ) );            
        // Get query vars
        $this->meta_or_tax = ( isset( $qry->query_vars['meta_or_tax'] ) ) ? $qry->query_vars['meta_or_tax'] : FALSE;
        if( $this->meta_or_tax )
        { 
            $this->tax_args = ( isset( $qry->query_vars['tax_query'] ) ) ? $qry->query_vars['tax_query'] : NULL;
            $this->meta_args = ( isset( $qry->query_vars['meta_query'] ) ) ? $qry->query_vars['meta_query'] : NULL;
            // Unset meta and tax query
            unset( $qry->query_vars['meta_query'] );
            unset( $qry->query_vars['tax_query'] );
        }
    }

    public function posts_clauses( $clauses )
    {       
        global $wpdb;       
        $field = 'ID';
        remove_filter( current_filter(), array( $this, __FUNCTION__ ) );    
        // Reconstruct the "tax OR meta" query
        if( $this->meta_or_tax && is_array( $this->tax_args ) &&  is_array( $this->meta_args )  )
        {
            // Tax query
            $tax_query = new WP_Tax_Query( $this->tax_args );
            $sql_tax = $tax_query->get_sql( $wpdb->posts, $field );
            // Meta query
            $meta_query = new WP_Meta_Query( $this->meta_args );
            $sql_meta = $meta_query->get_sql( 'post', $wpdb->posts, $field );
            // Where part
            if( isset( $sql_meta['where'] ) && isset( $sql_tax['where'] ) )
            {
                $t = substr( trim( $sql_tax['where'] ), 4 );
                $m = substr( trim( $sql_meta['where'] ), 4 );
                $clauses['where'] .= sprintf( ' AND ( %s OR  %s ) ', $t, $m );              
            }
            // Join/Groupby part
            if( isset( $sql_meta['join'] ) && isset( $sql_tax['join'] ) )
            {
                $clauses['join']    .= sprintf( ' %s %s ', $sql_meta['join'], $sql_tax['join'] );               
                $clauses['groupby'] .= sprintf( ' %s.%s ', $wpdb->posts, $field );
            }       
        }   
        return $clauses;
    }

}
