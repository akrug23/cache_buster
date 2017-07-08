<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cache_buster
{

   public $return_data  = "";

   public function __construct()
   {

      if (ee()->TMPL->fetch_param('file') != "") 
      {
         $file = ee()->TMPL->fetch_param('file');

         //Clean parameters
         $file = ee('Security/XSS')->clean($file);
      } else {
         $file = FALSE;
      }

      if (ee()->TMPL->fetch_param('separator') != "") 
      {
         $separator = ee()->TMPL->fetch_param('separator');

         //Clean parameters
         $separator = ee('Security/XSS')->clean($separator);
      } else {
         $separator = '?v=';
      }
      
      if (ee()->TMPL->fetch_param('root_path') != "") 
      {
         $root_path = ee()->TMPL->fetch_param('root_path');

         //Clean parameters
         $root_path = ee('Security/XSS')->clean($root_path);
      } else {
         $root_path = $_SERVER['DOCUMENT_ROOT'];
      }

      //Get real path
      $path = realpath($root_path . '/' . $file);

      //Get time of file
      $time = filemtime($path);


      //Bad path will return with out cache buster as to not break site
      //and display error in template log
      $return = $file;

      if ($time !== FALSE)
      {

         $return .= $separator . $time;

      } else {

         ee()->TMPL->log_item('CACHE BUSTER: File does not exist.');
      }

      $this->return_data = $return;

   }

   /**
    * Plugin Usage
    */

   // This function describes how the plugin is used.
   //  Make sure and use output buffering

   public static function usage()
   {
      ob_start(); 
?>

Using ExpressionEngine's CSS template provides a nice cache buster string of the most recent time
the template was saved to the database. This is quite handy but still requires EE to process the template.

This plugin will take a file path and use PHP to check the modification time returning a cache busting
string like ExpressionEngine's. This allows you to server flat files from your server without having
ExpressionEngine's template parser run through the code first. It is very simple to use.

There are 3 parameters. One is required and the other is optional.

{exp:cache_buster file="/css/style.css"}

This will return

/css/style.css?v=1266264101

Where "1266264101" is the UNIX timestamp of the last time /css/style.css was saved to the server.

You can change the separator between the file and the timestamp with the use of separator="" in the tag.

{exp:cache_buster file="/css/style.css" separator="?"}

This will return

/css/style.css?1266264101

If your file isn't being read by the plugin then the server root might not be the right path. The plugin assumes that your file will reside on your server's DOCUMENT_ROOT variable. If this is not accurate you can manually define the root with the root_path parameter. 

{exp:cache_buster file="/css/style.css" root_path="/home/mysite/subdirectory/templates"}

<?php
      $buffer         = ob_get_contents();

      ob_end_clean(); 

      return $buffer;
   }
   // END

}


/* End of file pi.cache_buster.php */
/* Location: ./system/user/cache_buster/pi.er_cache_buster.php */
