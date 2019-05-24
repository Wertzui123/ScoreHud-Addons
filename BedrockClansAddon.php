<?php
declare(strict_types = 1);
/**
 * @name BedrockClansAddon
 * @version 1.0.0
 * @main   JackMD\ScoreHud\Addons\BedrockClansAddon
 * @depend BedrockClans
 */
namespace JackMD\ScoreHud\Addons
{
    use JackMD\ScoreHud\addon\AddonBase;
    use pocketmine\Player;
    use Wertzui123\BedrockClans\Main;
    class BedrockClansAddon extends AddonBase{
        /** @var Main */
        private $BedrockClans;
        public function onEnable(): void{
            $this->BedrockClans = $this->getServer()->getPluginManager()->getPlugin("BedrockClans");
        }
        /**
         * @param Player $player
         * @return array
         */
        public function getProcessedTags(Player $player): array{
            return [
                "{clan_name}"   => $this->getPlayerClan($player),
		 "{clan_members}"   => $this->getPlayerClanMembers($player)
            ];
        }
        /**
         * @param Player $player
         */
        public function getPlayerClan(Player $player): string{
			if($this->BedrockClans->isInClan($player)){
		$clan = $this->BedrockClans->getClan($player);
                return $clan->get("name");
            }else{
                return "No Clan";
            }
		}
	    
	            /**
         * @param Player $player
         */
        public function getPlayerClanMembers(Player $player){
			if($this->BedrockClans->isInClan($player)){
		$clan = $this->BedrockClans->getClan($player);
                return $clan->get("members");
            }else{
                return "No Clan";
            }
		}
    }
}
