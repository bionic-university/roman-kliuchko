<?php

namespace BionicUniversity\Bundle\BlogBundle\EventListener;

use BionicUniversity\Bundle\BlogBundle\Entity\Post;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class PostListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof Post) {
            $object->setCreated(new \DateTime());
        }
    }
} 