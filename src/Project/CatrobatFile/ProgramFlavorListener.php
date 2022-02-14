<?php

namespace App\Project\CatrobatFile;

use App\DB\Entity\Project\Program;
use App\Project\Event\ProgramBeforePersistEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class ProgramFlavorListener
{
  private RequestStack $request_stack;

  public function __construct(RequestStack $stack)
  {
    $this->request_stack = $stack;
  }

  public function onEvent(ProgramBeforePersistEvent $event): void
  {
    $this->checkFlavor($event->getProgramEntity());
  }

  public function checkFlavor(Program $program): void
  {
    $request = $this->request_stack->getCurrentRequest();
    if (null == $request) {
      $program->setFlavor('pocketcode');
    } else {
      $program->setFlavor($request->attributes->get('flavor'));
    }
  }
}