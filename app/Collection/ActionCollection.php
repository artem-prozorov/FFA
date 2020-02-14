<?php


namespace App\Collection;

use App\Actions\AbstractAction;
use Gamez\Illuminate\Support\TypedCollection;

class ActionCollection extends TypedCollection
{
    protected static $allowedTypes = [AbstractAction::class];
}