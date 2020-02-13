<?php

namespace App\Actions;

use App\Contracts\TakeableInterface;

class Attack extends AbstractAction
{
    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return __('actions.take');
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return __('actions.take');
    }

    /**
     * @inheritDoc
     */
    public function isAvailable(): bool
    {
        return $this->getSubject() instanceof TakeableInterface;
    }
}
