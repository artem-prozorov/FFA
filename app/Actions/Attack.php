<?php

namespace App\Actions;

use App\Contracts\AttackableInterface;

class Attack extends AbstractAction
{
    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return __('actions.attack');
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return __('actions.attack');
    }

    /**
     * @inheritDoc
     */
    public function isAvailable(): bool
    {
        return $this->getSubject() instanceof AttackableInterface;
    }
}
