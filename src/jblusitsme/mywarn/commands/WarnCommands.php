<?php

namespace jblusitsme\mywarn\commands;

use jblusitsme\mywarn\Main;
use jblusitsme\mywarn\WarnAPI;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class WarnCommands extends Command {

  public function __construct() {
    parent::__construct("warn", "Warn player.", "/warn (user)");
    $this->setPermission(Main::$permissions);
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args) {
    if($sender instanceof Player) {
      if(!$this->testPermission($sender)) {
        return true;
      }
      if(isset($args[0])) {
        $user = $args[0];
        $form = new CustomForm(function(Player $sender, $data) use ($user) {
          if($data == null) {
            return true;
          }
          $message = $data[0];
          WarnAPI::addWarn($sender, $user, $message);
          return true;
        });
        $form->setTitle("Warn $user's");
        $form->addInput("Warn message", "Use bug");
        $form->sendToPlayer($sender);
      } else {
        $sender->sendMessage(Main::$config->get("prefix") . "§c " . $this->getUsage());
      }
    }
  }

}