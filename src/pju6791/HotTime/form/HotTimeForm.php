<?php

namespace pju6791\HotTime\form;

use pocketmine\Player;
use pocketmine\form\Form;

use pju6791\HotTime\form\HotTimeItemForm;
use pju6791\HotTime\form\HotTimeMoneyForm;

class HotTimeForm implements Form {

    public function jsonSerialize() :array {

        return [

            "type" => "form",
            "title" => "§l네버온라인 핫타임 시스템",
            "content" => "\n§r§b* §7사용하실 시스템을 선택해주세요.\n\n",
            "buttons" => [
                ["text" => "§l돈 지급\n§r§0- 핫타임 보상으로 돈을 지급합니다. -"],
                ["text" => "§l아이템 지급\n§r§0- 핫타임보상으로 아이템을 지급합니다. -"],
                ["text" => "§l창 닫기\n§r§0- 시스템을 종료합니다. -"]
            ]
        ];
    }

    public function handleResponse(Player $player, $data) :void {

        if(!isset($data)) return;

        if($data == 0) {
            $player->sendForm(new HotTimeMoneyForm());
        }

        if($data == 1) {
            $player->sendForm(new HotTimeItemForm($player));
        }
    }
}
