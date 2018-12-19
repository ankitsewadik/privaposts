<?php
/*
 * Plugin Name: Paulund WP List Table Example
 * Description: An example of how to use the WP_List_Table class to display data in your WordPress Admin area
 * Plugin URI: http://www.paulund.co.uk
 * Author: Paul Underwood
 * Author URI: http://www.paulund.co.uk
 * Version: 1.0
 * License: GPL2
 */

if(is_admin())
{
    new Paulund_Wp_List_Table();
}

/**
 * Paulund_Wp_List_Table class will create the page to load the table
 */
class Paulund_Wp_List_Table
{
    /**
     * Constructor will create the menu item
     */
    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'add_menu_example_list_table_page' ));
    }

    /**
     * Menu item will allow us to load the page to display the table
     */
    public function add_menu_example_list_table_page()
    {
        add_menu_page( 'Bank Verification List', 'Bank Verification List', 'manage_options', 'bank-verification', array($this, 'list_table_page') );
    }

    /**
     * Display the list table page
     *
     * @return Void
     */
    public function list_table_page()
    {
        $exampleListTable = new Example_List_Table();
        $exampleListTable->prepare_items();
        ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2>Example List Table Page</h2>
                <?php $exampleListTable->display(); ?>
            </div>
        <?php
    }
}

// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 10;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'          => 'ID',
            'name'        => 'Name',
            'dob'  => 'Date of Birth',
            'state'     => 'State',
            'city'         => 'City',
            'postalcode'        => 'Postal Code',
            'otherinfo'    =>  'Bank Details',
            'create_date'  => 'Create Date',
            'status'    =>  'Status' 
        );
        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array(
                'name'  => array('name' , false),
                'dob'  => array('dob' , false),
                'status'  => array('status' , false),
                'city'  => array('city' , false),
                'state'  => array('state' , false),
                'postalcode'  => array('postalcode' , false),
                'create_date'  => array('create_date' , false),
                'status'  => array('status' , false),

            );


    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
        $data = array();

		global $wpdb;

		$sql = "SELECT * FROM {$wpdb->prefix}bank_details";
		
		$result = $wpdb->get_results( $sql); 
		

		foreach ($result as $key => $value) {
				$status = ($value->status==0)?'Pending':'Approved';
				$bankrecord = unserialize($value->core_info);
				$html = '';
				if($bankrecord['iban'] !='') $html .= 'IBAN : '.$bankrecord['iban'].'<br>';
				if($bankrecord['account_holder_name'] !='') $html .= 'Account Holder Name : '.$bankrecord['account_holder_name'].'<br>';
				if($bankrecord['sort_code'] !='') $html .= 'Sort Code : '.$bankrecord['sort_code'].'<br>';
				if($bankrecord['account_number'] !='') $html .= 'Account Number : '.$bankrecord['account_number'].'<br>';
				if($bankrecord['clab'] !='') $html .= 'Clab : '.$bankrecord['clab'].'<br>';
				if($bankrecord['bsb'] !='') $html .= 'BSB : '.$bankrecord['bsb'].'<br>';
				if($bankrecord['bank_code'] !='') $html .= 'Bank Code : '.$bankrecord['bank_code'].'<br>';
				if($bankrecord['branch_code'] !='') $html .= 'Branch Code : '.$bankrecord['branch_code'].'<br>';
				if($bankrecord['uk_bank'] !='') $html .= 'UK Branch : '.$bankrecord['uk_bank'].'<br>';
				if($bankrecord['routing_number'] !='') $html .= 'Routing Number : '.$bankrecord['routing_number'].'<br>';
				if($bankrecord['bank_name'] !='') $html .= 'Bank Name : '.$bankrecord['bank_name'].'<br>';
				if($bankrecord['branch_name'] !='') $html .= 'Branch Name : '.$bankrecord['branch_name'].'<br>';
				if($bankrecord['clearing_code'] !='') $html .= 'Clearing Code : '.$bankrecord['clearing_code'].'<br>';
				if($bankrecord['transit_number'] !='') $$html .= 'Transit Code : '.$bankrecord['transit_number'].'<br>';
				if($bankrecord['institution_number'] !='') $html .= 'Institution Number : '.$bankrecord['institution_number'].'<br>';
                $html .= 'Country : '.$value->bank_country.'<br>';
			$data[] = array(
                    'id'          => $value->bank_id,
                    'name'        => $value->first_name.' '.$value->last_name,
                    'dob'  => $value->dob,
                    'city'         => $value->city,
                    'state'     => $value->state,
                    'postalcode'        => $value->postal_code ,
                    'create_date'   => $value->created_date, 
                    'otherinfo'   => $html,
                    'status'   => '<a class="a_status" href="#" attrs="'.$value->status.'"  attr="'.$value->bank_id.'" >'.$status.'</a>', 
                    );
			# code...
		}


		return $data;
   }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'name' :
            case 'dob' :
            case 'city' :
            case 'state' :
            case 'postalcode'  :
            case 'create_date' :
            case 'otherinfo' :
            case 'status' :
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'name' ;
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}
?>