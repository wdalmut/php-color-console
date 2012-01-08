<?php
namespace Wally\Console;
 
class Console
{
    private static $_instance;
    
    const GREEN = "green";
    const RED = "red";
    const YELLOW = "yellow";
    const BLUE = "blue";
    
    private $_colors = array(
        self::RED       => array("\033[31m", "\033[37m"),
        self::GREEN     => array("\033[32m", "\033[37m"),
        self::YELLOW    => array("\033[33m", "\033[37m"),
        self::BLUE      => array("\033[34m", "\033[37m")
    );
    
    private function __construct() {}
    private function __clone(){throw new \Exception("not supported");}
    
    private $_prefix;
    private $_postfix;
    
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
            
            list(self::$_instance->_prefix, self::$_instance->_postfix) = self::$_instance->_getColor(self::GREEN);
        }
        
        return self::$_instance;
    }
    
    private function _getColor($color)
    {
        return $this->_colors[$color];
    }
    
    public function setColor($color = self::GREEN) {
        list($this->_prefix, $this->_postfix) = self::$_instance->_getColor($color);
    }
    
    private function _isPosix()
    {
        return (function_exists('posix_isatty'));
    }
    
    public function _get($message)
    {
        if ($this->_isPosix()) {
            return $this->_prefix . $message . $this->_postfix;
        } else {
            return $message;
        }
    }
    
    public function sprintf()
    {
        $args = func_get_args();

        $message = array_shift($args);
        if (is_array($message)) { 
            $m = array_shift($message); 
            $args = $message;
            $message = $m; 
        }
        $message = vsprintf($message, $args);
        
        return $this->_get($message);
    }
    
    public function getAvailableColors()
    {
        return array_keys($this->_colors);
    }
    
    public function __call($method, $args)
    {
        $method = strtolower($method);
        
        $colors = $this->getAvailableColors();
        
        if (in_array($method, $colors)) {
            $this->setColor($method);
            
            return $this->sprintf($args);
        } else {
            throw new Exception("Color {$method} not available.");
        }
    }
}