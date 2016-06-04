<?php
namespace Nuovecode\SampleMenu\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;

class Topmenu implements ObserverInterface
{
    public $_storeManager;

    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Context $layout

    )
    {
        $this->_storeManager=$storeManager;
        $this->_request = $request;
        $this->_layout = $layout;

    }
    /**
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Framework\Data\Tree\Node $menu */
        $menu = $observer->getMenu();
        //$tree = $menu->getTree();

        $items = $menu->getChildren();
        foreach ($items as $item) {
            var_dump($item['id']);
        }


        $html = $this->_layout
            ->getLayout()
            ->createBlock('Magento\Cms\Block\Block')
            ->setBlockId('category-node-187')
            ->toHtml();

        var_dump($html);


       /**
        $data = [
            'name'      => __('Home'),
            'id'        => 'some-unique-id-here',
            'url'       => $this->_storeManager->getStore()->getBaseUrl(),
            'is_active' => $this->_request->getFullActionName() == 'cms_index_index' ? 'active':''
        ];
        $node = new Node($data, 'id', $tree, $menu);
        $menu->addChild($node);
        return $this;
       */
    }
}
