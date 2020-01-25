<?php
declare(strict_types=1);
/**
 * @name BedrockClansAddon
 * @version 1.0.0
 * @main   JackMD\ScoreHud\Addons\BedrockClansAddon
 * @depend BedrockClans
 */

namespace JackMD\ScoreHud\Addons {

    use JackMD\ScoreHud\addon\AddonBase;
    use pocketmine\Player;
    use Wertzui123\BedrockClans\Main;

    class BedrockClansAddon extends AddonBase
    {
        /** @var Main */
        private $BedrockClans;

        public function onEnable(): void
        {
            $this->BedrockClans = $this->getServer()->getPluginManager()->getPlugin("BedrockClans");
        }

        /**
         * @param Player $player
         * @return array
         */
        public function getProcessedTags(Player $player): array
        {
            return [
                "{clan_name}" => $this->getPlayerClan($player),
                "{clan_rank}" => $this->getPlayerClanRank($player),
                "{clan_members}" => $this->getPlayerClanMembers($player)
            ];
        }

        /**
         * @param Player $player
         * @return string
         */
        public function getPlayerClan(Player $player): string
        {
            $player = $this->BedrockClans->getPlayer($player);
			if ($player->isInClan()) {
                $clan = $player->getClan();
                return $clan->getName();
            } else {
                return "No Clan";
            }
		}

        /**
         * @param Player $player
         * @return string
         */
        public function getPlayerClanRank(Player $player)
        {
            $player = $this->BedrockClans->getPlayer($player);
            if ($player->isInClan()) {
                if ($player->isLeader()) {
                    return "Leader";
                } else {
                    return "Member";
                }
            } else {
                return "No Clan";
            }
        }

        /**
         * @param Player $player
         * @return string
         */
        public function getPlayerClanMembers(Player $player)
        {
            $player = $this->BedrockClans->getPlayer($player);
            if ($player->isInClan()) {
                $clan = $player->getClan();
                return (string)count($clan->getMembers());
            } else {
                return "No Clan";
            }
        }
    }
}
