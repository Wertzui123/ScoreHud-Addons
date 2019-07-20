<?php
declare(strict_types = 1);
/**
 * @name MyPlotAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\MyPlotAddon
 * @depend MyPlot
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use jasonwynn10\MyPlot\MyPlot;
	use pocketmine\Player;
	class MyPlotAddon extends AddonBase{
		/** @var MyPlot */
		private $MyPlot;
		public function onEnable(): void{
			$this->MyPlot = $this->getServer()->getPluginManager()->getPlugin("MyPlot");
		}
		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
			"{plotowner}" => $this->getPlot($this->MyPlot->getPlotByPosition($player->getPosition())),
			"{plotid}" => $this->getPlotID($this->MyPlot->getPlotByPosition($player->getPosition()))
            ];
		}
		public function getPlot($plot)
        {
            if ($plot !== null) {
                $owner = $plot->owner;
                if (empty($owner)) {
                    return "Free plot";
                } else {
                    return $owner;
                }
            } else {
                return "No plot";
            }
        }
            public function getPlotID($plot)
        {
            if ($plot !== null) {
                $x = $plot->X ?? 0;
                $z = $plot->Z ?? 0;
                return $x.";".$z;
            } else {
                return "No plot";
            }
        }
	}
}
