<?php declare(strict_types=1);namespace eggwars;use eggwars\commands\EggWarsCommand;use pocketmine\utils\TextFormat;use pocketmine\utils\Terminal;use eggwars\commands\TeamCommand;use eggwars\commands\VoteCommand;use eggwars\event\listener\ArenaSetupManager;use eggwars\event\listener\LevelSetupManager;use eggwars\utils\ConfigManager;use pocketmine\command\Command;use pocketmine\plugin\PluginBase;/**
 * Class EggWars
 * @package eggwars
 *
 * @author VixikCZ && ANDREAX22
 * @version 1.0.0 [DEV]
 * @api 3.0.0 - 4.0.0
 *
 * @copyright (c) ANDREX22 (2017 - 2019)
 */ class EggWars extends PluginBase{/** @var EggWars $instance */ private static $instance;/** @var ArenaManager $arenaManager */ private $arenaManager;/** @var LevelManager $levelManager */ private $levelManager;/** @var ArenaSetupManager $arenaSetupManager */ private $arenaSetupManager;/** @var LevelSetupManager $levelSetupManager */ private $levelSetupManager;/** @var ConfigManager $configManager */ private $configManager;/** @var Command[] $commands */ private $commands=[];public function onEnable(){self::$instance=$this;$this->registerCommands();$this->configManager=new ConfigManager;$this->levelManager=new LevelManager;$this->arenaManager=new ArenaManager;$this->arenaSetupManager=new ArenaSetupManager;$this->levelSetupManager=new LevelSetupManager;if($this->getDescription()->getAuthors()[0]!==base64_decode('QU5EUkVBWDIy') or $this->getDescription()->getName()!==base64_decode('RWdnV2Fycw==')){$this->getLogger()->info(base64_decode('RmF0YWwgZXJyb3IhIFVuYWxsb3dlZCB1c2Ugb2YgRWdnV2FycyB2MS4wLjAgYnkgQU5EUkVBWDIyLCB0ZWxlZ3JhbShAQU5EUkVBWDIyKSE='));$this->getServer()->shutdown();}else{$this->getLogger()->info(TextFormat::GREEN.base64_decode('RWdnV2FycyBieSBBTkRSRUFYMjIgRW5hYmxlZCwgdGVsZWdyYW0gQEFORFJFQVgyMiwgbXkgaG9zdGluZzogaHR0cHM6Ly93d3cuZGlyZWN0aG9zdGluZy5tZQ=='));}}public function onDisable(){$this->getArenaManager()->saveArenas();$this->getLevelManager()->saveLevels();}private function registerCommands(){$this->commands[base64_decode('ZWdnd2Fycw==')]=new EggWarsCommand;$this->commands[base64_decode('dm90ZQ==')]=new VoteCommand;$this->commands[base64_decode('dGVhbQ==')]=new TeamCommand;foreach($this->commands as $command){$this->getServer()->getCommandMap()->register(base64_decode('ZWdnd2Fycw=='),$command);}}/**
     * @return ArenaSetupManager $arenaSetupManager
     */ public function getSetupManager():ArenaSetupManager{return $this->arenaSetupManager;}/**
     * @return LevelSetupManager $levelSetupManager
     */ public function getLevelSetupManager():LevelSetupManager{return $this->levelSetupManager;}/**
     * @return ArenaManager $arenaManager
     */ public function getArenaManager():ArenaManager{return $this->arenaManager;}/**
     * @return LevelManager $levelManager
     */ public function getLevelManager():LevelManager{return $this->levelManager;}/**
     * @return ConfigManager
     */ public function getConfigManager():ConfigManager{return $this->configManager;}/**
     * @return string $prefix
     */ public static function getPrefix():string{return ConfigManager::getPrefix().base64_decode('IA==');}/**
     * @return EggWars $plugin
     */ public static function getInstance():EggWars{return self::$instance;}}?>