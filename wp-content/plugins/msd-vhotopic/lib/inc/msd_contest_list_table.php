<?php
/*
Plugin Name: Test List Table Example
*/

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class MSD_Contest_List_Table extends WP_List_Table {

    function __construct(){
    global $status, $page;

        parent::__construct( array(
            'singular'  => __( 'contest', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'contests', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => true        //does this table support ajax?

    ) );

    add_action( 'admin_head', array( &$this, 'admin_header' ) );            

    }

  function admin_header() {
    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if( 'my_list_test' != $page )
    return;
    echo '<style type="text/css">';
    echo '.wp-list-table .column-id { width: 5%; }';
    echo '.wp-list-table .column-contest { width: 50%; }';
    echo '.wp-list-table .column-start { width: 20%; }';
    echo '.wp-list-table .column-end { width: 20%;}';
    echo '</style>';
  }

  function no_items() {
    _e( 'No contests found.' );
  }

  function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'contest':
        case 'start':
        case 'end':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_sortable_columns() {
  $sortable_columns = array(
    'contest'  => array('contest',false),
    'start' => array('start',false),
    'end'   => array('end',false)
  );
  return $sortable_columns;
}

function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'contest' => __( 'Contest Name', 'mylisttable' ),
            'start'    => __( 'Contest Starts', 'mylisttable' ),
            'end'      => __( 'Contest Ends', 'mylisttable' )
        );
         return $columns;
    }

function usort_reorder( $a, $b ) {
  // If no sort, default to title
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'end';
  // If no order, default to asc
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  // Determine sort order
  $result = strcmp( $a[$orderby], $b[$orderby] );
  // Send final sort direction to usort
  return ( $order === 'asc' ) ? $result : -$result;
}

function column_booktitle($item){
  $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&contest=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&contest=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );

  return sprintf('%1$s %2$s', $item['contest'], $this->row_actions($actions) );
}

function get_bulk_actions() {
  $actions = array(
    'delete'    => 'Delete'
  );
  return $actions;
}

function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="contest[]" value="%s" />', $item['ID']
        );    
    }

function prepare_items() {
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = $this->get_sortable_columns();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  usort( $this->example_data, array( &$this, 'usort_reorder' ) );
  
  $per_page = 5;
  $current_page = $this->get_pagenum();
  $total_items = count( $this->example_data );

  // only ncessary because we have sample data
  $this->found_data = array_slice( $this->example_data,( ( $current_page-1 )* $per_page ), $per_page );

  $this->set_pagination_args( array(
    'total_items' => $total_items,                  //WE have to calculate the total number of items
    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
  ) );
  $this->items = $this->found_data;
}

} //class