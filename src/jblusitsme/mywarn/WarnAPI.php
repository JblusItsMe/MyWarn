<?php

namespace jblusitsme\mywarn;

use pocketmine\player\Player;

class WarnAPI {

  public static function setDefault(Player $sender): void {
    if(!Main::$warn->exists($sender->getName())) {
      Main::$warn->set($sender->getName(), array(
        "count" => 0,
        "list" => []
      ));
      try {
        Main::$warn->save();
      } catch (\JsonException $e) {}
    }
  }

  public static function addWarn(Player $sender, string $name, string $raison): void {
    if(Main::$warn->exists($name)) {
      if(Main::getInstance()->getServer()->getPlayerExact($name)) {
        $a = Main::$warn->get($name)["list"];
        array_push($a, $raison);

        Main::$warn->set($name, array(
          "count" => Main::$warn->get($name)["count"] + 1,
          "list" => $a
        ));
        try {
          Main::$warn->save();
        } catch(\JsonException $e) {}

        $player = Main::getInstance()->getServer()->getPlayerExact($name);

        $player->sendMessage(str_replace(
          array("{prefix}", "{reason}"),
          array(Main::$config->get("prefix"), $raison),
          Main::$config->get("messages")["warn"]["playerMessage"]
        ));
        $sender->sendMessage(str_replace(
          array("{prefix}", "{user}", "{reason}"),
          array(Main::$config->get("prefix"), $player->getName(), $raison),
          Main::$config->get("messages")["warn"]["adminMessage"]
        ));
      } else {
        $sender->sendMessage(str_replace(
          array("{prefix}"),
          array(Main::$config->get("prefix")),
          Main::$config->get("messages")["warn"]["playerNotExists"]
        ));
      }
    } else {
      $sender->sendMessage(str_replace(
        array("{prefix}"),
        array(Main::$config->get("prefix")),
        Main::$config->get("messages")["warn"]["playerNotExists"]
      ));
    }
  }

}