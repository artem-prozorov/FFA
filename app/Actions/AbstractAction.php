<?php

namespace App\Actions;

use App\Models\{Player};
use App\Contracts\PositionableInterface;

abstract class AbstractAction
{
    /**
     * @var Player $actor
     */
    protected $actor;

    /**
     * @var PositionableInterface $subject
     */
    protected $subject;

    public function __construct(Player $actor, PositionableInterface $subject)
    {
        $this->actor = $actor;
        $this->subject = $subject;
    }

    /**
     * Get the value of actor
     *
     * @access	public
     * @return	Player
     */
    public function getActor(): Player
    {
        return $this->actor;
    }

    /**
     * Get the value of actor
     *
     * @access	public
     * @return	PositionableInterface
     */
    public function getSubject(): PositionableInterface
    {
        return $this->subject;
    }

    /**
     * Get action description
     *
     * @access	public
     * @return	string
     */
    abstract public function getDescription(): string;

    /**
     * Get action title
     *
     * @access	public
     * @return	string
     */
    abstract public function getTitle(): string;

    /**
     * Returns true if the action is available
     *
     * @access	public
     * @return	bool
     */
    abstract public function isAvailable(): bool;
}
