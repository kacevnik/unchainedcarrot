<?php

    /**
     * @return string
     * Custom screen output function for checking
     */
    if ( !function_exists( 'dump' ) ) {
        function dump( $var ) {
            echo '<pre style="color: #c3c3c3; background-color: #282923;">';
            print_r( $var );
            echo '</pre>';
        }
    }

?>