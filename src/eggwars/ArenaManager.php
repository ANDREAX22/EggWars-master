<?php declare(strict_types=1);namespace eggwars;use eggwars\arena\Arena;use eggwars\utils\ConfigManager;use pocketmine\Player;use pocketmine\utils\Config;/**
 * Class ArenaManager
 * @package eggwars
 */ class ArenaManager extends ConfigManager{/**
     * @var Arena[] $arenas
     */ public $arenas=[];public function __construct(){$this->initConfig();$this->loadArenas();}/**
     * @param string $name
     * @return Arena $arena
     */ public function createArena(string $name){if($this->arenaExists($name)){$this->getPlugin()->getLogger()->critical(base64_decode('QXJlbmEgYWxyZWFkeSBleGlzdHMh'));return null;}$data=$this->defaultArenaData;$data[base64_decode('bmFtZQ==')]=$name;$arenaConfig=new Config($this->getDataFolder()."arenas/$name.yml",Config::YAML,$data);$arenaConfig->save();return $arena=$this->arenas[$name]=new Arena($this->getPlugin(),$arenaConfig);}public function removeArena(string $name){if(!$this->arenaExists($name)){return;}unset($this->arenas[$name]);unlink($this->getDataFolder()."arenas/$name.yml");}/**
     * @param string $name
     * @return bool $bool
     */ public function arenaExists(string $name):bool{return boolval(isset($this->arenas[$name]));}/**
     * @param string $name
     * @return Arena
     */ public function getArenaByName(string $name):Arena{return $this->arenas[$name];}/**
     * @param Player $player
     * @return Arena|bool
     */ public function getArenaByPlayer(Player $player){$arena=false;foreach($this->arenas as $arenas){if($arenas->inGame($player)){$arena=$arenas;}}return $arena;}/**
     * @return string $list
     */ public function getListArenasInString():string{$list=[];foreach($this->arenas as $name=>$arena){$name=$arena->isEnabled()?"§b$name §aENABLED":"§b$name §cDISABLED";array_push($list,$name);}if(count($list)==0){return base64_decode('w4LCp2NUaGVyZSBhcmUgbm8gYXJlbmFz');}return base64_decode('w4LCp2FBcmVuYXMgKA==').count($list).base64_decode('KToK').implode(base64_decode('Cg=='),$list);}/**
     * @param bool $force
     */ public function saveArenas($force=false){/**
         * @var string $name
         * @var Arena $arena
         */ foreach($this->arenas as $name=>$arena){if(is_file($this->getArenaDataFolder().base64_decode('Lw==').$name.base64_decode('LnltbA=='))){$config=new Config($this->getArenaDataFolder().base64_decode('Lw==').$name.base64_decode('LnltbA=='),Config::YAML);$config->setAll($arena->arenaData);$config->save();}else{$config=new Config($this->getArenaDataFolder().base64_decode('Lw==').$name.base64_decode('LnltbA=='),Config::YAML,$arena->arenaData);$config->save();}$this->getPlugin()->getLogger()->notice("Arena {$name} is successfully saved!");}}/**
     * @param bool $reload
     */ private function loadArenas($reload=false){foreach(glob($this->getArenaDataFolder().base64_decode('LyoueW1s'))as $file){$this->loadArena($file);}}/**
     * @param string $configPath
     */ private function loadArena(string $configPath){$this->arenas[basename($configPath,base64_decode('LnltbA=='))]=new Arena($this->getPlugin(),new Config($configPath,Config::YAML));}/**
     * @return EggWars $plugin
     */ public function getPlugin(){return EggWars::getInstance();}}?>