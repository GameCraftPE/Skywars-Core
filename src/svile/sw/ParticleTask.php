<?php

namespace svile\sw;

use pocketmine\scheduler\PluginTask;
use pocketmine\Server;
use pocketmine\level\particle\FlameParticle;
use pocketmine\Player;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\math\AxisAlignedBB;
use pocketmine\utils\TextFormat as TF;

class ParticleTask extends PluginTask{

  /** @var float */
  private $degrees;

  private $plugin;

  public function __construct($plugin){
    parent::__construct($plugin);
    $this->plugin = $plugin;
  }

  public function onRun(int $currentTick){
    foreach($this->plugin->getServer()->getOnlinePlayers() as $p) {
      if($p->getLevel()->getName() === "Lobby" or $p->getLevel()->getName() === "Hub"){
        if($p->hasPermission("rank.lapis")) {
          $x = (cos(deg2rad($this->degrees)) * 0.6) + $p->x;
          $z = (sin(deg2rad($this->degrees)) * 0.6) + $p->z;
          $p->getLevel()->addParticle(new FlameParticle(new Vector3($x, $p->y + 2.2, $z)));
          if($this->degrees === 360) {
            $this->degrees = 0;
          } else {
            $this->degrees += 6;
          }
        }
      }
    }
  }
}
