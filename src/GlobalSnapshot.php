<?php

    namespace victorwesterlund;

    // Capture the current state of all superglobals.
    // This will save a copy of all keys and values and any changes made to the superglobals 
    // can be restored to this point in time by calling $this->restore();
    class GlobalSnapshot {
        // Declare all PHP superglobals
        private array $_ENV;
        private array $_GET;
        private array $_POST;
        private array $_FILES;
        private array $_SERVER;
        private array $_COOKIE;
        private array $_REQUEST;
        private array $_SESSION;

		// Declare additional PHP globals (for PHP 8.0+ compatability)
		// These will not be captured, or altered by GlobalSnapshot
        private int $argc;
        private array $argv;
        private ?array $__composer_autoload_files; // Native support for composer

        public bool $captured = false;

        public function __construct() {}

        // Wipe all superglobals
        private function truncate(string $global) {
            global $$global;
            $$global = [];
        }

        // Restore state of superglobals at the time of capture()
        public function restore() {
            foreach ($this as $global => $values) {
                global $$global;

                $this->truncate($global);
                $$global = $this->{$global};
            }
        }

		// Store current state of superglobals
        public function capture() {
            $this->captured = true;
            
            foreach (array_keys($GLOBALS) as $global) {
                $this->{$global} = $GLOBALS[$global];
            }
        }
    }