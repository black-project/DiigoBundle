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

class DiigoAPI
{
  
  const VERSION = '0.1';
  
  protected static $_url = 'http://api2.diigo.com/';
  
  protected
      $_username,
      $_password,
      $_key,
      $_arguments = array();
  
  
  /**
   * Constructor
   * 
   * @param       string  $_key          The key API (not required, diigo API is... hum... young)
   * @param       string  $_username     The username (for HTTP AUTH)
   * @param       string  $_password     The password (for HTTP AUTH)
   * @param       array   $_arguments    An array of arguments
   * 
   * @return      object  DiigoAPI
   */
  public function __construct($key = null, $username = null, $password = null)
  {
      if(null !== $key)
      {
          $this->setKey($key);
      }
      
      if(null !== $username)
      {
          $this->setUsername($username);
      }
      
      if(null !== $password)
      {
          $this->setPassword($password);
      }
      
      $this->setArguments($this->_arguments);
  }
  
 
  
  /**
   * Get bookmarks of an user
   * 
   * @param       array $arguments    An array of arguments
   * 
   * @return      array $reponse     The content of response
   */
  public function getBookmarks(array $arguments = array())
  {   
      if(null != $arguments)
      {
          $this->_arguments = \array_merge($this->_arguments, $arguments);
      }
      
      $uri = $this->_getUri('bookmarks');
      
      $client = $this->_getApi($uri);
      $client->setParameterGet($this->_arguments);

      $response = $client->request('GET');  
              
      if($response === $this->_verifyHeader($response))
      {
          $body = $response->getBody();
      }
      else
      {
          $body = $this->_verifyHeader($response);
      }
      
      $result = json_decode($body);
      
      return $result;
  }
  
  
  /**
   * Save new bookmark
   * 
   * @todo        kick the diigo's developpers ass
   * 
   * @param       array $_arguments    An array of arguments
   * 
   * @return      nothing
   */
  public function saveBookmark(array $arguments = array())
  {   
      if(null == $arguments)
      {
        return 'An error occured';
      }
      
      foreach($arguments as $key => $value)
      {
        $arguments[$key] = urlencode($value);
      }
      
      $this->_arguments = \array_merge($this->_arguments, $arguments);
      
      $uri = $this->_getUri('bookmarks');
      
      $client = $this->_getApi($uri);
      $client->setParameterPost($this->_arguments);
      
      $reponse = $client->request('POST');
              
      if($response === $this->_verifyHeader($response))
      {
          $body = $response->getBody();
      }
      else
      {
          $body = $this->_verifyHeader($response);
      }
      
      $result = json_decode($body);
      
      return $result;
  }
  
  /**
   * Get a bookmark of an user
   * 
   * @param       string  $id          Id from the getBookmarks() object
   * @param       array   $_arguments    An array of arguments
   * 
   * @return      array   $result      The bookmark
   */
  public function getBookmark($id)
  {
    $bookmarks = $this->getBookmarks($this->_arguments);
    
    $result = $bookmarks[$id];
    
    return $result;
  }
  
  /**
   * Reset all arguments
   * 
   * @return DiigoAPI 
   */
  public function resetArguments()
  {
    $this->_arguments = array();
    $this->_arguments = \array_merge($this->_key, $this->_arguments);
    
    return $this;
  }
  
  /**
   * Set the API key
   * 
   * @param       string    $key      Your API key
   * @return                $this 
   */
  public function setKey($key)
  {
      $this->_key = array('key' => $key);
      return $this;
  }
  
  /**
   * Set your username
   * 
   * @param       string    $username      Your username
   * @return                $this 
   */
  public function setUsername($username)
  {
      $this->_username = $username;
      return $this;
  }
  
  /**
   * Set your password
   * 
   * @param       string    $password     Your password
   * @return                $this 
   */
  public function setPassword($password)
  {
    $this->_password = $password;
    return $this;
  }
  
  /**
   *
   * @param array $arguments
   * @return DiigoAPI 
   */
  public function setArguments($arguments)
  {
    $this->_arguments = \array_merge($arguments, $this->_key);
    
    return $this;
  }
  
  /**
   *
   * @return type 
   */
  public function getKey()
  {
    return $this->_key;
  }
  
  /**
   *
   * @return type 
   */
  public function getUsername()
  {
    return $this->_username;
  }
  
  /**
   *
   * @return type 
   */
  public function getPassword()
  {
    return $this->_password;
  }
  
  /**
   *
   * @return type 
   */
  public function getArguments()
  {
    return $this->_arguments;
  }
  
  /**
   *
   * @param type $user
   * @return DiigoAPI 
   */
  public function setUser($user)
  {
    $this->_arguments = \array_merge($this->_arguments, array('user' => $user));
    
    return $this;
  }
  
  /**
   *
   * @param type $start
   * @return DiigoAPI 
   */
  public function setStart($start)
  {
    $this->_arguments = \array_merge($this->_arguments, array('start' => $start));
    
    return $this;
  }
  
  /**
   *
   * @param type $count
   * @return DiigoAPI 
   */
  public function setCount($count)
  {
    $this->_arguments = \array_merge($this->_arguments, array('count' => $count));
    
    return $this;
  }
  
  /**
   *
   * @param type $sort
   * @return DiigoAPI 
   */
  public function setSort($sort)
  {
    $this->_arguments = \array_merge($this->_arguments, array('sort' => $sort));
    
    return $this;
  }
  
  /**
   *
   * @param type $tags
   * @return DiigoAPI 
   */
  public function setTags($tags)
  {
    $this->_arguments = \array_merge($this->_arguments, array('tags' => $tags));
    
    return $this;
  }
  
  /**
   *
   * @param type $filter
   * @return DiigoAPI 
   */
  public function setFilter($filter)
  {
    $this->_arguments = \array_merge($this->_arguments, array('filter' => $filter));
    
    return $this;
  }
  
  /**
   *
   * @param type $list
   * @return DiigoAPI 
   */
  public function setList($list)
  {
    $this->_arguments = \array_merge($this->_arguments, array('list' => $list));
    
    return $this;
  }
  
  /**
   *
   * @param type $title
   * @return DiigoAPI 
   */
  public function setTitle($title)
  {
    $this->_arguments = \array_merge($this->_arguments, array('title' => $title));
    
    return $this;
  }
  
  /**
   *
   * @param type $url
   * @return DiigoAPI 
   */
  public function setUrl($url)
  {
    $this->_arguments = \array_merge($this->_arguments, array('url' => $url));
    
    return $this;
  }
  
  /**
   *
   * @param type $shared
   * @return DiigoAPI 
   */
  public function setShared($shared)
  {
    $this->_arguments = \array_merge($this->_arguments, array('shared' => $shared));
    
    return $this;
  }
  
  /**
   *
   * @param type $desc
   * @return DiigoAPI 
   */
  public function setDesc($desc)
  {
    $this->_arguments = \array_merge($this->_arguments, array('desc' => $desc));
    
    return $this;
  }
  
  /**
   *
   * @param type $readLater
   * @return DiigoAPI 
   */
  public function setReadLater($readLater)
  {
    $this->_arguments = \array_merge($this->_arguments, array('readLater' => $readlater));
    
    return $this;
  }
  
  /**
   * Create a new http client
   * 
   * @param       string $uri           The base url
   * @param       string $httpMethod    HTTP method (default GET)
   * 
   * @return      array  $client    The http client
   */
  protected function _getApi($uri)
  {
      $api = $this->_createZendClient();
      $api->setConfig(array(
                          'maxredirects'  => 0,
                          'timeout'       => 30,
                          'adapter'       => 'Zend\\Http\\Client\\Adapter\\Curl',
                          'keepalive'     => true
                      ));
      
      $api->setUri($uri);
      $api->setAuth($this->_username, $this->_password, ZendClient::AUTH_BASIC);
      
      return $api;
  }
  
  /**
   * Vertif the status of the response
   * 
   * @param type $client 
   */
  protected function _verifyHeader($response)
  {
      $header = $client->getStatus();
      
      switch($header)
      {
          case '200':
              return $client;
          case '400':
              return '{"error": "400 Bad Request"}';
          case '401':
              return '{"error": "401 Not authorized"}';
          case '403':
              return '{"error": "403 Forbidden"}';
          case '404':
              return '{"error": "404 Not found"}';
          case '500':
              return '{"error": "500 Internal Server Error"}';
          case '502':
              return '{"error": "502 Bad Gateway"}';
          case '503':
              return '{"error": "Service Unavailable"}';
      }

  }
  
  /**
   * Create the uri
   * 
   * @param       string  $apiMethod    The method api
   * @param       array   $arguments      An array of arguments
   * 
   * @return      string  $uri          The complete url
   */
  protected function _getUri($apiMethod)
  {
      $uri = sprintf('%s/%s', self::$_url, $apiMethod);

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