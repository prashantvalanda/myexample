<?php
 
namespace Training4\Warranty\Setup;
 
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
 
    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
 
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 
        /**
         * Add attributes to the eav/attribute
         */
 
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'warranty',
            [
                'type' => 'text',
                'backend' => 'Training4\Warranty\Model\Backend\Changeyear',
                'frontend' => 'Training4\Warranty\Model\Frontend\Bolddata',
                'label' => 'Warranty',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => 0,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
    }
}