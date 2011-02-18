<?php

/**
 * Interface for api class
 * 
 * @package     DiigoBudnle
 * @subpackage  Service
 * @author      alexandre 'pocky' Balmes
 */

namespace Blackroom\DiigoBundle\Service;

interface ServiceInterface
{
    /**
     * Returns a list of bookmarks
     * 
     * @return array
     */
    public function getBookmarks(array $_options);
    
    /**
     * Save a bookmark
     * 
     */
    public function saveBookmark(array $_options);
}
