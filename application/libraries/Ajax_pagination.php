<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pagination Class
 *
 * @package   CodeIgniter
 * @link      http://codeigniter.com/user_guide/libraries/pagination.html
 *
 * Modified by CodexWorld.com
 * @Ajax pagination functionality has added with this library.
 * @It will helps to integrate Ajax pagination with loading image in CodeIgniter application.
 * @TutorialLink http://www.codexworld.com/ajax-pagination-in-codeigniter-framework/
 */
class Ajax_pagination{

    var $base_url        = '';
    var $total_rows      = '';
    var $per_page        = 10;
    var $num_links       =  2;
    var $cur_page        =  0;
    var $first_link      = 'First';
    var $next_link       = '&#187;';
    var $prev_link       = '&#171;';
    var $last_link       = 'Last';
    var $uri_segment     = 3;
    var $full_tag_open   = '';
    var $full_tag_close  = '';
    var $first_tag_open  = '';
    var $first_tag_close = '';
    var $last_tag_open   = '';
    var $last_tag_close  = '';
    var $cur_tag_open    = '<div class="page active">';
    var $cur_tag_close   = '</div>';
    var $next_tag_open   = '';
    var $next_tag_close  = '';
    var $prev_tag_open   = '';
    var $prev_tag_close  = '';
    var $num_tag_open    = '';
    var $num_tag_close   = '';
    var $target          = '';
    var $anchor_class    = '';
    var $show_count      = true;
    var $link_func       = 'searchFilter';
    var $loading         = '.load-wrapper';

    /**
     * Constructor
     * @access    public
     * @param    array    initialization parameters
     */
    function CI_Pagination($params = array()){
        if (count($params) > 0){
            $this->initialize($params);
        }
        log_message('debug', "Pagination Class Initialized");
    }

    /**
     * Initialize Preferences
     * @access    public
     * @param    array    initialization parameters
     * @return    void
     */
    function initialize($params = array()){
        if (count($params) > 0){
            foreach ($params as $key => $val){
                if (isset($this->$key)){
                    $this->$key = $val;
                }
            }
        }

        // Apply class tag using anchor_class variable, if set.
        if ($this->anchor_class != ''){
            $this->anchor_class = 'class="' . $this->anchor_class . '" ';
        }
    }

    /**
     * Generate the pagination links
     * @access    public
     * @return    string
     */
    function create_links(){
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0){
           return '';
        }

        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);

        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1){
            $info = 'Showing : ' . $this->total_rows;
            return $info;
        }

        // Determine the current page number.
        $CI =& get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0){
            $this->cur_page = $CI->uri->segment($this->uri_segment);
            // Prep the current page - no funny business!
            $this->cur_page = (int) $this->cur_page;
        }

        $this->num_links = (int)$this->num_links;
        if ($this->num_links < 1){
            show_error('Your number of links must be a positive number.');
        }

        if ( ! is_numeric($this->cur_page)){
            $this->cur_page = 0;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $this->total_rows){
            $this->cur_page = ($num_pages - 1) * $this->per_page;
        }

        $uri_page_number = $this->cur_page;
        $this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') .'/';

        // And here we go...
        $output = '';

        // SHOWING LINKS
        if ($this->show_count){
            $curr_offset = $CI->uri->segment($this->uri_segment);
            $info = 'Showing ' . ( $curr_offset + 1 ) . ' to ' ;

            if( ( $curr_offset + $this->per_page ) < ( $this->total_rows -1 ) )
            $info .= $curr_offset + $this->per_page;
            else
            $info .= $this->total_rows;

            $info .= ' of ' . $this->total_rows . ' | ';
            // $output .= $info;
            $output .= '';
        }

        // Render the "First" link
        if  ($this->cur_page > $this->num_links){
            $output .= $this->first_tag_open
                    . $this->getAJAXlink( '' , $this->first_link)
                    . $this->first_tag_close;
        }

        // Render the "previous" link
        if  ($this->cur_page != 1){
            $i = $uri_page_number - $this->per_page;
            if ($i == 0) $i = '';
            $output .= $this->prev_tag_open
                    . $this->getAJAXlink( $i, $this->prev_link )
                    . $this->prev_tag_close;
        }

        // Write the digit links
        for ($loop = $start -1; $loop <= $end; $loop++){
            $i = ($loop * $this->per_page) - $this->per_page;
            if ($i >= 0){
                if ($this->cur_page == $loop){
                    $output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
                }else{
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open
                        . $this->getAJAXlink( $n, $loop )
                        . $this->num_tag_close;
                }
            }
        }

        // Render the "next" link
        if ($this->cur_page < $num_pages){
            $output .= $this->next_tag_open
                . $this->getAJAXlink( $this->cur_page * $this->per_page , $this->next_link )
                . $this->next_tag_close;
        }

        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages){
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $output .= $this->last_tag_open . $this->getAJAXlink( $i, $this->last_link ) . $this->last_tag_close;
        }

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        // Add the wrapper HTML if exists
        $output = $this->full_tag_open.$output.$this->full_tag_close;
        return $output;
    }

    function getAJAXlink($count, $text) {
        $pageCount = $count?$count:0;
        return '<div class="page" href="javascript:void(0);"' . $this->anchor_class . ' onclick="'.$this->link_func.'('.$pageCount.')">'. $text .'</div>';
    }
}
