<?php

namespace jblusitsme\mywarn\commands;

use jblusitsme\mywarn\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class WarnListCommands extends Command {

  public function __construct() {
    parent::__construct("warnlist", "User warn", "/warnlist (user)");
    $this->setPermission(Main::$permissions);
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args) {
    if($sender instanceof Player) {
      if(!$this->testPermission($sender)) {
        return true;
      }
      if(isset($args[0])) {
        $user = $args[0];
        if(Main::$warn->get($user)["count"] > 0) {
          $sender->sendMessage(str_replace(
            array("{prefix}", "{user}", "{number}"),
            array(Main::$config->get("prefix"), $user, Main::$warn->get($user)["count"]),
            Main::$config->get("messages")["warnlist"]["warn"]
          ));
          foreach(Main::$warn->get($user)["list"] as $warning) {
            $sender->sendMessage("§l§7-§r §f$warning");
          }
        } else {
          $sender->sendMessage(str_replace(
            "{prefix}",
            Main::$config->get("prefix"),
            Main::$config->get("messages")["warnlist"]["noWarn"]
          ));
        }
      } else {
        $sender->sendMessage(Main::$config->get("prefix") . "§c " . $this->getUsage());
      }
    }
  }

}