<?php


namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;


class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    /**
     * @var EntityManager
     */
    private $em;
    public function __construct(EntityManagerInterface $em,Security $security)
    {
        $this->em = $em;
        $this->security=$security;
    }
    public function loadData(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStart();
        $endDate = $calendarEvent->getEnd();
        $filters = $calendarEvent->getFilters();

        //You may want do a custom query to populate the events

        $evts = $this->em->getRepository(\ClubBundle\Entity\Event::class)->findAll();
        foreach ($evts as $evt)
        {
            $calendarEvent->addEvent(new \ClubBundle\Entity\Event($evt->getNom(), $evt->getDateDebut()));
        }
    }
}