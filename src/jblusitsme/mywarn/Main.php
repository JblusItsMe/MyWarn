<?php

namespace jblusitsme\mywarn;

use jblusitsme\mywarn\commands\WarnCommands;
use jblusitsme\mywarn\commands\WarnListCommands;
use jblusitsme\mywarn\events\PlayerListener;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

  public static Main $instance;

  public static string $permissions = "warn.perm";
  public static Config $config;
  public static Config $warn;

  protected function onEnable(): void {
    $this->getLogger()->notice("§fpar §6JblusItsMe");

    self::$instance = $this;
    self::$warn = new Config($this->getDataFolder() . "warn.yml", Config::YAML);

    self::$config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [
      "version" => "1.0.0",
      "prefix" => "§6MyWarn §7>§r",
      "messages" => array(
        "warn" => array(
          "playerNotExists" => "{prefix} §cThe player does not exist on the server.",
          "adminMessage" => "{prefix} You warned §e{user}§r for the reason §e{reason}§r.",
          "playerMessage" => "{prefix} You were warned by a staff member for the reason §e{reason}§r."
        ),
        "warnlist" => array(
          "noWarn" => "{prefix} §cThe user has no warning.",
          "warn" => "{prefix} §e{user}§r has §e{number}§r warnings:"
        )
      )
    ]);

    $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
    $this->getServer()->getCommandMap()->registerAll("mywarn", [
      new WarnCommands(), new WarnListCommands()
    ]);
  }

  public static function getInstance(): Main {
    return self::$instance;
  }

}