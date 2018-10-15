<?php
 
namespace Baniwal\CategoryThumbnail\Setup;
 
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
 
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
 
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
 
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
	// PLACEHOLDER: add attribute code goes here
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY,'catthumb',
            [
                'type' => 'varchar',
                'label' => 'Categories Thumbnail slider',
                'input' => 'select',
                'required' => false,
                'sort_order' => 4,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'visible'       => 1,
                'required'      => 0,
                'user_defined'  => 1, 
            ]
        );                  
 
        $setup->endSetup();
    }
}