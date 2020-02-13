<?php

namespace App\Actions;

use App\Contracts\AttackableInterface;

class Attack extends AbstractAction
{
    public function getDescription(): string
    {
        return __('actions.attack');
    }

    public function getTitle(): string
    {
        return __('actions.attack');
    }

    public function isAvailable(): bool
    {
        if (parent::getSubject() instanceof AttackableInterface) {
            return true;
        }

        return false;
    }
}
