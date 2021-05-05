<?php

namespace pju6791\HotTime\form;

use pocketmine\Player;
use pocketmine\form\Form;

use pju6791\HotTime\HotTime;

use function is_numeric;

class HotTimeMoneyForm implements Form {

    public function jsonSerialize() :array {

        return [

            "type" => "form",
            "title" => "§l네버온라인 아이템지급",
            "content" => [
                ["type" => "input", "text" => "§r§b* §7지급하실 금액을 적어주세요."]
            ]
        ];
    }

    public function handleResponse(Player $player, $data): void
    {
        if(!isset($data)) return;

        if($data[0] == null) {
            $player->sendMessage(HotTime::$prefix["info"] . "빈칸이 있으면 안됩니다.");
        } else {
            HotTime::getInstance()->HotTimeMoney((int)$data[0]);
        }

        if($data[0] < 0) {
            $player->sendMessage(HotTime::$prefix["info"] . "0보다 커야됩니다.");
        } elseif (!is_numeric($data[0])) {
            $player->sendMessage(HotTime::$prefix["info"] . "숫자로 입력해주세요.");
        }
    }
}
