<?php
namespace Baniwal\CategoryThumbnail\Block;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Catthumb extends \Magento\Framework\View\Element\Template
{
    protected $collectionFactory;

    public function __construct(
    // CollectionFactory $collectionFactory,
    \Magento\Framework\View\Element\Template\Context $context
    ) {
        // $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function sayHello()
    {
        return __('Hello World');
    }

    public function getCategories()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $categoryFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
        $categories = $categoryFactory->create()   
        // $_categories = $this->collectionFactory->create()
        ->addAttributeToSelect('name')
        ->addAttributeToSelect('url_key')
        ->addAttributeToSelect('thumbnail')
        ->addAttributeToSelect('description')
        //->setLoadProductCount(true)
        ->addAttributeToFilter('is_active',array('eq'=>true))
        ->addAttributeToFilter('catthumb',array('eq'=>true))
        ->addAttributeToSort('name')
        ->load();
        return $categories;
    }


    public function getCatResizedSlider($cat , $quality = 100) {
        if (! $cat->getThumbnail())
            return false;

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');

        $mediaUrl =$storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $imageUrl = $mediaUrl.'catalog/category/'.$cat->getThumbnail();

        // if (! is_file ( $imageUrl ))
        //     return false;

        // $imageResized = $mediaUrl.'catalog/category/'.$cat->getThumbnail();
        // Because clean Image cache function works in this folder only
        // if (! file_exists ( $imageResized ) && file_exists ( $imageUrl ) || file_exists($imageUrl) && filemtime($imageUrl) > filemtime($imageResized)) :
        //     $imageObj = new Varien_Image ( $imageUrl );
        // $imageObj->constrainOnly ( true );
        // $imageObj->keepAspectRatio ( true );
        // $imageObj->keepFrame ( true ); // ep
        // $imageObj->quality ( $quality );
        // $imageObj->keepTransparency(true);  // png
        // $imageObj->backgroundColor(array(255,255,255));
        // $imageObj->resize ( 255, 255 );
        // $imageObj->save ( $imageResized );
        // endif;
        
        // if(file_exists($imageResized)){
        //     echo '123'; die();
        //     return $mediaUrl.'catalog/category/'.$cat->getThumbnail();
        // }else{
        //     echo '345'; die();
        //     return $this->getImageUrl();
        // }
        return $imageUrl;

    }


}
