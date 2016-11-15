<?php
namespace Mystore\Slider\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Save extends \Magento\Backend\App\Action
{

	protected $_fileUploaderFactory;
	
	protected $filesystem;

    /**
     * @param Action\Context $context
     */
    public function __construct(\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
								\Magento\Framework\Filesystem $filesystem,
								Action\Context $context)
    {
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mystore_Slider::save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
		
        if ($data) {			
			
			if (isset($_FILES['image']) && isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {
			
				try {
				
					$uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
			  
					$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
					  
					$uploader->setAllowRenameFiles(false);
					  
					$uploader->setFilesDispersion(false);
				 
					$path = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
					  
					->getAbsolutePath('images/');
					  
					$uploader->save($path);	

					$data['image'] = 'images/'.$_FILES['image']['name'];
				
				} catch (\Exception $e) {
					
					if ($e->getCode() == 0) {
						$this->messageManager->addError($e->getMessage());
					}
				}
			
			} else {
				if (isset($data['image']) && isset($data['image']['value'])) {
					if (isset($data['image']['delete'])) {
						$data['image'] = '';
						$data['delete_image'] = true;
					} elseif (isset($data['image']['value'])) {
						$data['image'] = $data['image']['value'];
					} else {
						$data['image'] = '';
					}
				}
			}
			
            
            $model = $this->_objectManager->create('Mystore\Slider\Model\Slider');

            $id = $this->getRequest()->getParam('slider_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);            

            try {
					$model->save();
					$this->messageManager->addSuccess(__('You saved this Slider.'));
					$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
					if ($this->getRequest()->getParam('back')) {
						return $resultRedirect->setPath('*/*/edit', ['slider_id' => $model->getId(), '_current' => true]);
					}
					return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['slider_id' => $this->getRequest()->getParam('slider_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}