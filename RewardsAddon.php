<?php
declare(strict_types=1);
/**
 * @name RewardsAddon
 * @version 1.0.0
 * @main   JackMD\ScoreHud\Addons\RewardsAddon
 * @depend Rewards
 */

namespace JackMD\ScoreHud\Addons {

    use JackMD\ScoreHud\addon\AddonBase;
    use pocketmine\Player;
    use Wertzui123\Rewards\Main;

    class RewardsAddon extends AddonBase
    {
        /** @var Main */
        private $Rewards;

        public function onEnable(): void
        {
            $this->Rewards = $this->getServer()->getPluginManager()->getPlugin("Rewards");
        }

        /**
         * @param Player $player
         * @return array
         */
        public function getProcessedTags(Player $player): array
        {
            return [
                "{reward_wait_time}" => $this->getWaitTime($player),
                "{reward_streak}" => $this->getStreak($player)
            ];
        }

        /**
         * @param Player $player
         * @return int
         */
        public function getWaitTime(Player $player): int
        {
            return $this->Rewards->getWaitTime($player);
        }

        /**
         * @param Player $player
         * @return int
         */
        public function getStreak(Player $player): int
        {
            return $this->Rewards->getStreak($player);
        }

    }
}
