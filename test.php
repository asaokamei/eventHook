<?php
require_once 'eventHook.php';

function doFunction( $arg1=NULL, $args=NULL ) {
    echo "doSomething( '$arg1', '$args' )\n";
}

class doClass {
    function doMethod( $arg1=NULL, $args=NULL ) {
        echo "doSomething( '$arg1', '$args' )\n";
    }
}

eventHook::hook( 'test1', 'doFunction' );
eventHook::event( 'test1' );
eventHook::event( 'test1', 'arg1' );
eventHook::event( 'test1', 'arg1', 'arg2' );
eventHook::event( 'test1', 'arg1', 'arg2', 'arg3' );

$doStatic = array( 'doClass', 'doMethod' );
eventHook::hook( 'test2', $doStatic );
eventHook::event( 'test2', 'arg1', 'arg2' );

$do = new doClass();
$doInst = array( $do, 'doMethod' );
eventHook::hook( 'test3', $doInst );
eventHook::event( 'test3', 'arg1', 'arg2' );

?>
