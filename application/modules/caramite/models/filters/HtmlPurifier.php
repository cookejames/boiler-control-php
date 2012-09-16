<?php
class Caramite_Filter_HtmlPurifier implements Zend_Filter_Interface
{
    protected $_htmlPurifier = null;
    
    public function __construct ()
    {
        require_once 'HTMLPurifier/HTMLPurifier.auto.php';
        
        $config = HTMLPurifier_Config::createDefault();
        
        $config->set(
        		'HTML.Allowed', 
        		'p,em,h1,h2,h3,h4,h5,strong,a[href],ul,ol,li,code,pre,' .
         		'blockquote,img[src|alt|height|width],sub,sup,br'
        );
        
//         $config->set('AutoFormat.Linkify', 'true');
        
//         $config->set('AutoFormat.AutoParagraph', 'true');
        
        $this->_htmlPurifier = new HTMLPurifier($config);
    }
    
    public function filter ($value, $type = null)
    {
    	if ($type !== null) {
			$value = $this->cast($value, $type); 
    	}
    	
        return $this->_htmlPurifier->purify($value);
    }
    
    public function cast($value, $type)
    {
    	switch ($type) {
    		case "int" :
    			return (int) $value;
    		case "decimal" :
    			return (float) $value;
    		case "bool" :
    			return (boolean) $value;
    		default : 
    			return $value;
    	}
    }
}
