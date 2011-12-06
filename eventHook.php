<?php

/**
 * hooks to events.
 * @see
 * http://stackoverflow.com/questions/6846118/event-driven-architecture-and-hooks-in-php
 * @author Asao Kamei
 */
class eventHook
{
    static $hooks = array();
	// +--------------------------------------------------------------- +
    static public function hook( $event, $callback ) {
        if( !is_callable( $callback ) ) {
            throw new RuntimeException( "not callable hook to event '{$event}'" );
        }
        if( !isset( self::$hooks[ $event ] ) ) {
            self::$hooks[ $event ] = array();
        }
        self::$hooks[ $event ][] = $callback;
    }
	// +--------------------------------------------------------------- +
    static public function fire( $event, $args=array() ) {
        if( isset( self::$hooks[$event] ) ) {
            foreach( self::$hooks[$event] as $callback ) {
                call_user_func_array( $callback, $args );
            }
        }
    }
	// +--------------------------------------------------------------- +
    static public function event( $event ) {
        $input = func_get_args();
        $args  = array_slice( $input, 1 );
        self::fire( $event, $args );
    }
	// +--------------------------------------------------------------- +
}

?>
