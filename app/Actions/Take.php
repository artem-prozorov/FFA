<?php

namespace App\Actions;

use App\Contracts\TakeableInterface;

class Attack extends AbstractAction
{
    public function getDescription(): string
    {
        return __('actions.take');
    }

    public function getTitle(): string
    {
        return __('actions.take');
    }

    public function isAvailable(): bool
    {
        if (parent::getSubject() instanceof TakeableInterface) {
            return true;
        }

        return false;
    }
}
