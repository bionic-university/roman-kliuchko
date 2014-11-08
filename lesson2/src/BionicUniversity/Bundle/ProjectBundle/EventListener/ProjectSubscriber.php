<?php

namespace BionicUniversity\Bundle\ProjectBundle\EventListener;

use BionicUniversity\Bundle\ProjectBundle\Entity\Project;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectSubscriber implements EventSubscriber
{
    /** @var  \Swift_Mailer */
    private $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /** {@inheritdoc} */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'postPersist',
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof Project) {
            $object
                ->setCreated(new \DateTime())
                ->setStatus($this->findInitialStatus($args->getObjectManager()));
        }
    }

    /**
     * @param LifecycleEventArgs $args$object
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof Project) {
            echo "developer notified\n";
        }
    }

    /**
     * @param ObjectManager $em
     *
     * @return \BionicUniversity\Bundle\ProjectBundle\Entity\Status
     */
    private function findInitialStatus(ObjectManager $em)
    {
        return $em
            ->getRepository('BionicUniversityProjectBundle:Status')
            ->findOneBy([
                'name' => Project::DEFAULT_STATUS,
            ]);
    }
}