<?php
/**
 * Human Element Inc.
 *
 * @package HE_TwoFactorAuth
 * @copyright Copyright (c) 2017 Human Element Inc. (https://www.human-element.com)
 * @license GPL (https://www.gnu.org/copyleft/gpl.html)
 */

namespace HE\TwoFactorAuth\Controller\Adminhtml;

class Duo extends \Magento\Backend\App\Action
{

    /**
     * @var \HE\TwoFactorAuth\Helper\Data
     */
    protected $twoFactorAuthHelper;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Backend\Model\Session
     */
    protected $backendSession;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $backendAuthSession;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \HE\TwoFactorAuth\Model\Validate\DuoFactory
     */
    protected $twoFactorAuthValidateDuoFactory;

    /**
     * @var \Magento\User\Model\UserFactory
     */
    protected $userUserFactory;

    /**
     * @var \HE\TwoFactorAuth\Model\Validate\GoogleFactory
     */
    protected $twoFactorAuthValidateGoogleFactory;

    /**
     * @var \HE\TwoFactorAuth\Model\Validate\Duo\RequestFactory
     */
    protected $twoFactorAuthValidateDuoRequestFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \HE\TwoFactorAuth\Helper\Data $twoFactorAuthHelper,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Backend\Model\Session $backendSession,
        \Magento\Backend\Model\Auth\Session $backendAuthSession,
        \Magento\Framework\App\Request\Http $request,
        \HE\TwoFactorAuth\Model\Validate\DuoFactory $twoFactorAuthValidateDuoFactory,
        \Magento\User\Model\UserFactory $userUserFactory,
        \HE\TwoFactorAuth\Model\Validate\GoogleFactory $twoFactorAuthValidateGoogleFactory,
        \HE\TwoFactorAuth\Model\Validate\Duo\RequestFactory $twoFactorAuthValidateDuoRequestFactory
    ) {
        $this->twoFactorAuthHelper = $twoFactorAuthHelper;
        $this->resultPageFactory = $resultPageFactory;
        $this->logger = $logger;
        $this->backendSession = $backendSession;
        $this->backendAuthSession = $backendAuthSession;
        $this->request = $request;
        $this->twoFactorAuthValidateDuoFactory = $twoFactorAuthValidateDuoFactory;
        $this->userUserFactory = $userUserFactory;
        $this->twoFactorAuthValidateGoogleFactory = $twoFactorAuthValidateGoogleFactory;
        $this->twoFactorAuthValidateDuoRequestFactory = $twoFactorAuthValidateDuoRequestFactory;

        $this->_shouldLog = $this->twoFactorAuthHelper->shouldLog();
        $this->_shouldLogAccess = $this->twoFactorAuthHelper->shouldLogAccess();

        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        if ($this->_shouldLog) {
            $this->logger->log(\Monolog\Logger::EMERGENCY, "duoAction start");
        }
        $msg = __('Please complete the DUO two factor authentication');
        $this->backendSession->addNotice($msg);

        $page = $this->resultPageFactory->create();
        return $page;
    }
}