<?php

namespace BionicUniversity\Bundle\ProjectBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Swift_Mailer;

class UserListener
{
    /** @var  Swift_Mailer */
    private $mailer;

    /**
     * @param Swift_Mailer $mailer
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        // todo notify user or something
        echo "notification done\n";
    }
} 