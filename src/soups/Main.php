<?php

namespace soups;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase  implements Listener
{
    public function onEnable(): void
    {
        $this->getLogger()->info("Plugin Soups bien activé !");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
    }
    public function Soups(PlayerItemUseEvent $event)
    {
        $player = $event->getPlayer();
        if ($player->getInventory()->getItemInHand()->getId() == $this->getConfig()->get("id")) {
            if ($player->getHealth() == $player->getMaxHealth()) {
                $event->cancel();
            } else {
                $item = $event->getItem();
                $item->setCount("1");
                $player->setHealth($player->getHealth() + $this->getConfig()->get("heal_add"));
                $player->getInventory()->removeItem($item);
            }
        }
    }
}
