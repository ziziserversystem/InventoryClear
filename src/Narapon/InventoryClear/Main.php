<?php

namespace Narapon\InventoryClear;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\inventory\PlayerInventory;


class Main extends PluginBase {

    public function onEnable(){
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):  bool {
        switch($cmd->getName()) {
            case "ic":
                if(isset($args[0])) {
                    if($sender->hasPermission("clearinventory.other")) {
                        $player = $this->getServer()->getPlayer($args[0]);
                        if($player) {
                            $player->getInventory()->clearAll();
                            $playername = $player->getName();
                            $last_letter = substr($playername, -1);
                            if($last_letter === "s" || $last_letter === "z" || $last_letter === "x") {
                                $sender->sendMessage("§a【運営】 §e " . $player->getDisplayName() . " のインベントリを削除しました");
                            } else {
                                $sender->sendMessage("§a【運営】 §e " . $player->getDisplayName() . " のインベントリを削除しました");
                            }
                        } else {
                             $sender->sendMessage("§a【運営】 §e指定したプレイヤーはいません");
                        }
                    }
                } else {
                    if($sender->hasPermission("clearinventory.own")) {
                        $sender->getInventory()->clearAll();
                        $sender->sendMessage("§a【運営】 §eあなたのインベントリを削除しました");
                    }
                }
                break;
        }
        return false;
    }
}
