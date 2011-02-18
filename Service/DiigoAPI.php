<?php

/**
 * The diigo api class
 * 
 * @package     DiigoBudnle
 * @subpackage  Service
 * @author      alexandre 'pocky' Balmes
 */

namespace Blackroom\DiigoBundle\Service;

use Zend\Http\Client as ZendClient;

class DiigoAPI implements ServiceInterface
{
  
  const VERSION = '0.1';
  
  protected static $_url = 'https://secure.diigo.com/api/v2/bookmarks';
  
  protected
      $_username,
      $_password,
      $_key,
      $_options;
  
  /**
   * Constructor
   * 
   * @param       string  $_key          The key API (not required, diigo API is... hum... young)
   * @param       string  $_username     The username (for HTTP AUTH)
   * @param       string  $_password     The password (for HTTP AUTH)
   * @param       array   $_options      An array of options
   * 
   * @return      object  DiigoAPI
   */
  public function __construct($_key, $_username, $_password, array $_options = array())
  {
      $this->key      = array('key' => $_key);     
      $this->options  = \array_merge($this->key, $_options);
      $this->username = $_username;
      $this->password = $_password;
  }
  
  /**
   * Get bookmarks of an user
   * 
   * @param       array $_options    An array of options
   * 
   * @return      array $reponse     The content of response
   */
  public function getBookmarks(array $_options)
  {   
      $options = \array_merge($this->options, $_options);
      
      $uri = $this->_getUri($options, 'GET');
      
      $client = $this->_createClient($uri);
      
      $response = $client->request();
      
      return $response->getBody();
  }
  
  
  /**
   * Save new bookmark
   * 
   * @todo        make the code :)
   * 
   * @param       array $_options    An array of options
   * 
   * @return      nothing
   */
  public function saveBookmark(array $_options)
  {
      return null;
  }
  
  
  /**
   * Create a new http client
   * 
   * @param       string $uri       The base url
   * @method      string $method    HTTP method (default GET)
   * 
   * @return      array $client     The http client
   */
  protected function _createClient($uri, $method = 'GET')
  {
      $client = $this->_createZendClient();
      $client->setConfig(array(
          'maxredirects'  => 0,
          'timeout'       => 30,
          'adapter'       => 'Zend\\Http\\Client\\Adapter\\Curl',
          'method'        => $method
      ));
      $client->setUri($uri);
      $client->setAuth($this->username, $this->password, ZendClient::AUTH_BASIC);
      
      return $client;
  }
  
  /**
   * Create the uri
   * 
   * @param       array   $options      An array of options
   * 
   * @return      string  $uri          The complete url
   */
  protected function _getUri($options)
  {
      $uri = sprintf('%s?%s', self::$_url, http_build_query($options));

      return $uri;
  }
  
  /**
   * Create a new Zend Client
   * 
   * @return      object ZendClient
   */
  protected function _createZendClient()
  {
      return new ZendClient();
  }
  
}