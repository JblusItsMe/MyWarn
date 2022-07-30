<?php

namespace jblusitsme\mywarn\events;

use jblusitsme\mywarn\WarnAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class PlayerListener implements Listener {

  public function onJoin(PlayerJoinEvent $event) {
    $sender = $event->getPlayer();
    WarnAPI::setDefault($sender);
  }

}