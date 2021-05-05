<?php

namespace pju6791\HotTime\command;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;

use pju6791\HotTime\form\HotTimeForm;

class HotTimeCommand extends Command {

    public function __construct() {
        parent::__construct("핫타임", "HotTime Command");
        $this->setPermission(Permission::DEFAULT_OP);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $player = $sender;

        if($player instanceof Player) {
            if($player->hasPermission($this->getPermission())) {
                $player->sendForm(new HotTimeForm());
            }
        }
    }
}
