<?php

namespace pju6791\HotTime\form;

use pocketmine\Player;
use pocketmine\form\Form;

use pju6791\HotTime\HotTime;
use function pju6791\HotTime\ItemName;

class HotTimeItemForm implements Form {

    public $player;

    public function __construct(Player $player) {
        $this->player = $player;
    }

    public function jsonSerialize() :array {

        $item = ItemName($this->player->getPlayer());

        return [

            "type" => "form",
            "title" => "§l네버온라인 아이템지급",
            "content" => "\n§r§b* §7{$item}을(를) 보상으로 지급하시겠습니까?\n\n",
            "buttons" => [
                ["text" => "§l예\n§r§0- {$item}을(를) 보상으로 지급합니다. -"],
                ["text" => "§l아니오\n§r§0- 시스템을 종료합니다. -"]
            ]
        ];
    }

    public function handleResponse(Player $player, $data): void
    {
        if(!isset($data)) return;

        if($data == 0) {
            HotTime::getInstance()->HotTimeItem($player);
        }
    }
}
