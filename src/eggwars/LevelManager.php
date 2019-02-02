<?php declare(strict_types=1);namespace eggwars;use eggwars\arena\Arena;use eggwars\level\EggWarsLevel;use eggwars\utils\ConfigManager;use pocketmine\level\Level;use pocketmine\utils\Config;/**
 * Class LevelManager
 * @package eggwars
 */ class LevelManager extends ConfigManager{/** @var EggWarsLevel[] $level */ private $levels=[];/**
     * LevelManager constructor.
     */ public function __construct(){$this->loadLevels();}/**
     * @param Arena $arena
     * @return array|bool $levels
     */ public function getLevelsForArena(Arena $arena){$levels=[];foreach($this->levels as $level){if(in_array($arena->getName(),$level->data[base64_decode('YXJlbmFz')])){if($level->isValid()){array_push($levels,$level);}else{EggWars::getInstance()->getLogger()->critical("§cLevel {$level->getCustomName()} is not valid!");}}}check:if(count($levels)<3){if(count($levels)===0){return false;}array_push($levels,$levels[0]);goto check;}shuffle($levels);return $levels;}public function saveLevels(){/**
         * @var string $name
         * @var EggWarsLevel $level
         */ foreach($this->levels as $name=>$level){if(is_file($this->getDataFolder().base64_decode('bGV2ZWxzLw==').$name.base64_decode('LnltbA=='))){$config=new Config($this->getDataFolder().base64_decode('bGV2ZWxzLw==').$name.base64_decode('LnltbA=='),Config::YAML);$config->setAll($level->data);$config->save();}else{$config=new Config($this->getDataFolder().base64_decode('bGV2ZWxzLw==').$name.base64_decode('LnltbA=='),Config::YAML,$level->data);$config->save();}EggWars::getInstance()->getLogger()->notice("Level {$name} is successfully saved!");}}public function loadLevels(){foreach(glob($this->getDataFolder().base64_decode('bGV2ZWxzLyoueW1s'))as $file){$config=new Config($file,Config::YAML);$this->levels[basename($file,base64_decode('LnltbA=='))]=new EggWarsLevel($config->getAll());}}/**
     * @param $name
     * @return EggWarsLevel $name
     */ public function getLevelByName($name){return isset($this->levels[$name])?$this->levels[$name]:null;}/**
     * @return string $list
     */ public function getListLevelsInString():string{$list=[];foreach($this->levels as $name=>$level){array_push($list,"§b$name");}if(count($list)==0){return base64_decode('w4LCp2NUaGVyZSBhcmUgbm8gbGV2ZWxz');}return base64_decode('w4LCp2FMZXZlbHMgKA==').count($list).base64_decode('KTog').implode(base64_decode('Cg=='),$list);}/**
     * @param string $name
     * @return bool
     */ public function levelExists(string $name):bool{return isset($this->levels[$name]);}/**
     * @param string $levelName
     */ public function removeLevel(string $levelName){unset($this->levels[$levelName]);unlink($this->getDataFolder()."levels/$levelName.yml");}/**
     * @param Level $level
     * @param string $levelName
     * @param null $data
     */ public function addLevel(Level $level,string $levelName,$data=null){$data=is_array($data)?$data:$this->defaultLevelData;$data[base64_decode('bGV2ZWxOYW1l')]=$level->getName();$data[base64_decode('Zm9sZGVyTmFtZQ==')]=$level->getFolderName();$data[base64_decode('bmFtZQ==')]=$levelName;$this->levels[$levelName]=new EggWarsLevel($data);}}?>