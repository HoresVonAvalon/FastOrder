<?php declare(strict_types=1);

namespace Shopware\Core\Content\Flow\Dispatching\Action;

use Shopware\Core\Framework\Event\FlowEvent;

class StopFlowAction extends FlowAction
{
    public static function getName(): string
    {
        return 'action.stop.flow';
    }

    /**
     * @return array<string, string|array{0: string, 1: int}|list<array{0: string, 1?: int}>>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::getName() => 'handle',
        ];
    }

    public function requirements(): array
    {
        return [];
    }

    public function handle(FlowEvent $event): void
    {
        $event->stop();
    }
}
