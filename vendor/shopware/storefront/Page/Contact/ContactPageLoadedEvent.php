<?php declare(strict_types=1);

namespace Shopware\Storefront\Page\Contact;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\PageLoadedEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * @deprecated tag:v6.5.0 the according controller was already removed, use store-api ContactRoute instead
 */
class ContactPageLoadedEvent extends PageLoadedEvent
{
    /**
     * @var ContactPage
     */
    protected $page;

    public function __construct(ContactPage $page, SalesChannelContext $salesChannelContext, Request $request)
    {
        $this->page = $page;
        parent::__construct($salesChannelContext, $request);
    }

    public function getPage(): ContactPage
    {
        return $this->page;
    }
}
