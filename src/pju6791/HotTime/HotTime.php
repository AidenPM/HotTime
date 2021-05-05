<?php

namespace pju6791\HotTime;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;

use pju6791\HotTime\command\HotTimeCommand;

use onebone\economyapi\EconomyAPI;

use function class_exists;

function ItemName($player) {

    if($player instanceof Player) {
        $item = $player->getInventory()->getItemInHand();
        if($item->hasCustomName()) {
            return $item->getCustomName();
        } else {
            return $item->getName();
        }
    }
}

class HotTime extends PluginBase {

    public static $prefix = [
        "server" => "§l§a[핫타임] §r§f",
        "info" => "§l§b[알림] §r§7"
    ];

    public static $instance = null;

    public static function getInstance() :?HotTime {
        return self::$instance;
    }

    public function onLoad() {
        self::$instance = $this;
    }

    public function onEnable() {

        $this->getServer()->getCommandMap()->register('pju6791', new HotTimeCommand());

        if(!class_exists(EconomyAPI::class)) {
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }
    }

    public function HotTimeMoney(int $money) {

        $server = Server::getInstance();
        $economy = EconomyAPI::getInstance();

        foreach ($server->getOnlinePlayers() as $onlinePlayer) {
            $money_hottime = EconomyAPI::getInstance()->koreanWonFormat($money);
            $economy->addMoney($onlinePlayer, $money_hottime);
            $onlinePlayer->sendMessage(self::$prefix["server"] . "§b{$money_hottime}§7을 핫타임 보상으로 지급받으셨습니다.");
        }
    }

    public function HotTimeItem(Player $player) {

        $server = Server::getInstance();
        $item = $player->getInventory()->getItemInHand();
        $name = ItemName($player);

        foreach ($server->getOnlinePlayers() as $onlinePlayer) {
            $onlinePlayer->getInventory()->addItem($item);
            $player->sendMessage(self::$prefix["server"] . "§b{$name}을(를)§7핫타임 보상으로 지급받으셨습니다.");
        }
    }
}
