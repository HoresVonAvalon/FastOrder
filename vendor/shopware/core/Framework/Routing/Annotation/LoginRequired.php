<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Routing\Annotation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

/**
 * @deprecated tag:v6.5.0 - Use route defaults with "_loginRequired". Example: @Route(defaults={"_loginRequired"=true)
 * Annotation for store-api/storefront
 *
 * @Annotation
 */
class LoginRequired implements ConfigurationInterface
{
    /**
     * @var bool
     */
    private $allowGuest;

    public function __construct(array $values)
    {
        $this->allowGuest = isset($values['allowGuest']) ? $values['allowGuest'] : false;
    }

    /**
     * @return string
     */
    public function getAliasName()
    {
        return 'loginRequired';
    }

    /**
     * @return bool
     */
    public function allowArray()
    {
        return false;
    }

    public function isLoggedIn(SalesChannelContext $context): bool
    {
        if ($context->getCustomer() === null) {
            return false;
        }

        if ($context->getCustomer()->getGuest() && $this->isAllowGuest() === false) {
            return false;
        }

        return true;
    }

    public function isAllowGuest(): bool
    {
        return $this->allowGuest;
    }

    public function setAllowGuest(bool $allowGuest): void
    {
        $this->allowGuest = $allowGuest;
    }
}
