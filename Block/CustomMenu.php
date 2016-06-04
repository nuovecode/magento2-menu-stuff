<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Nuovecode\SampleMenu\Block;


class CustomMenu extends \Magento\Theme\Block\Html\Topmenu {

    /**
     * @param \Magento\Framework\Data\Tree\Node $child
     * @param string $childLevel
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string
     */

    protected function _addSubMenu($child, $childLevel, $childrenWrapClass, $limit)
    {
        $html = '';
        if (!$child->hasChildren()) {
            return $html;
        }

        $colStops = null;
        if ($childLevel == 0 && $limit) {
            $colStops = $this->_columnBrake($child->getChildren(), $limit);
        }

        $html .= '<ul class="level' . $childLevel . ' submenu">';
        $html .= $this->_getHtml($child, $childrenWrapClass, $limit, $colStops);

        if ($childLevel == 0) {
            $staticBlock = trim($this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($child->getId())->toHtml());
            if(!empty($staticBlock)){
                $html .= '<div class="top-menu-block">';
                $html .= $staticBlock;
                $html .= '</div>';
            }
        }

        $html .= '</ul>';
        return $html;
    }

    /**
     * @return string
     */

    protected function _toHtml()
    {
        $this->setModuleName($this->extractModuleName('Magento\Theme\Block\Html\Topmenu'));
        return parent::_toHtml();
    }

}
