<?php
/**
 * @category    Oggymenu
 * @package     Rockforweb_Oggymenu
 * @copyright   Copyright (c) 2015 Rockforweb (http://www.rockforweb.com/)
 */
class Rockforweb_Oggymenu_Block_Menu extends Mage_Core_Block_Template
{
    public function getCategories($categories)
    {
        $array= '<ul>';
        foreach($categories as $category) {
            $cat = Mage::getModel('catalog/category')->load($category->getId());
            $count = $cat->getProductCount();
            $array .= '<li>' .
                '<a href="' . Mage::getUrl($cat->getUrlPath()). '">' .
                $category->getName() . "(" . $count . ")</a>\n";
            if($category->hasChildren()) {
                $children = Mage::getModel('catalog/category')->getCategories($category->getId());
                $array .=  $this->getCategories($children);
            }
            $array .= '</li>';
        }

        return  $array . '</ul>';
    }
}
