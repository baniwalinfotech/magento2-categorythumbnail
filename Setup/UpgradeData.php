<?php
 
namespace Baniwal\CategoryThumbnail\Setup;
 
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
 
class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;
 
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
 
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        if ($context->getVersion() && version_compare($context->getVersion(), '1.0.1') < 0) {
 
            // PLACEHOLDER: add attribute code goes here
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 
            $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY,'thumbnail',
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
        }
 
        $setup->endSetup();
    }
}