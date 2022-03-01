<?php

namespace theohdg2\BlockCraft;


use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class BlockCraft extends PluginBase implements Listener
{
    protected function onEnable(): void
    {
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }
    public function onCraft(CraftItemEvent $event){
        foreach ($this->getConfig()->get("bloqued-craft") as $name => $output){
            $e = explode(":",$output);
            if($event->getOutputs()[0]->getId() == (int)$e[0] && $event->getOutputs()[0]->getMeta() == (int)$e[1]){
                $event->cancel();
            }
        }
        $this->getConfig()->reload();
    }
}