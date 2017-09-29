	<?php
	
	defined('_APPEXEC') or die('Restricted access');
	
	class mTeamView extends mBaseView {
		
		/**
		 * This function will present the teams website URL if it is present.
		 * 
		 * @param JLTeamView $team
		 * @return fsLink|string
		 */
		function getWebsiteUrl(JLTeamView $team) {
			$teamobj = $team->getTeam();
			if (strlen($teamobj->getWebsite())>0) {
				return new fsLink($teamobj->getWebsite(),"Click Here");
			} else {
				return "Not Available";
			}
		}
		
		/**
		 * This function will return the link to the teams USSSA page.
		 * 
		 * @param JLTeamView $team
		 * @return fsLink|string
		 */
		function getUSSSAProfileUrl(JLTeamView $team) {
			$app = &mFactory::getApp();
			$teamobj = $team->getTeam();
			$config = &mConfig::getInstance();
			$url = $config->getProperty('sanctioning_body_team_url') . $teamobj->getFieldValue("FLD_USSSA_NUMBER");
			if (_APPDEBUG) {
				$app->writeDebug("USSSA URL=" . $url);
			}
			if (strlen($teamobj->getFieldValue("FLD_USSSA_NUMBER"))>0) {
				return new fsLink($url,$teamobj->getFieldValue("FLD_USSSA_NUMBER"));
			} else {
				return "Not Available";
			}
		}
		
		/**
		 * This function will return the team profile menu.
		 * 
		 * @param unknown $element_name
		 * @param unknown $default_value
		 * @param unknown $classname
		 * @param unknown $teamid
		 * @param string $slug
		 * @return string
		 */
		function getTeamProfileMenu($element_name, $default_value, $classname, $teamid, $slug = null) {
	
			$app = &mFactory::getApp();
			$config = $app->getConfig();
			
			if ($slug == null) {
				$slug = $teamid;
			}
			
			$seasonsvc = & JLSeasonService::getInstance();
			$season = $seasonsvc->getCurrentSeason();
			
			$obj = new fsSelectList($element_name, $default_value);
			$obj->setHeader("------- Select Menu Option -------");
			$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $slug), "View Team Profile");
			$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=editTeamProfile&teamid=" . $slug), "Edit Profile");
			$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=uploadLogo&teamid=" . $slug), "Upload Logo");
			$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=manageContacts&teamid=" . $slug), "Manage Team Contacts");
			$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=updateFieldInfo&teamid=" . $slug), "Manage Fields/Venues");
			
			if ($config->getProperty('schedules_enabled')) {
				if ($season->isSetupFinal()) {
					$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=manageSchedule&teamid=" . $slug), "Schedule / Game Scores");
				}
			}
			if ($config->getProperty('rosters_enabled')) {
				$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=manageRoster&teamid=" . $slug), "Manage Roster");
			}
			$rsvc = &JLRegistrationService::getInstance();
			if ($rsvc->isRegistrationOpen()) {
				// Get current season open for registration
				$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=registrations&task=register&teamid=" . $teamid), "Register for Next Season");
			}
			if ($season->isSetupFinal()) {
				$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=getteamcontactlist"), "Create Contact List");
			}
			if ($config->getProperty('bulletins_enabled')) {
				$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=manageBulletins&teamid=" . $slug), "Manage Bulletins");
			}		
			if ($config->getProperty('events_enabled')) {
				$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=manageEvents&teamid=" . $slug), "Manage Events");
			}
			if ($season->isSetupFinal()) {
				$obj->addOption("http://swibl-baseball.org/v1/doclibrary/2017/2017-leaguesetupdoc-final-01-11-17-rev.pdf", "View League Setup Doc");
			}
			$obj->setAttribute("onchange", "window.location	= this.value;");
			if ($classname != null) {
				$obj->setAttribute("class", $classname);
			}
			return $obj->toHtml();
					
		}
		
		/**
		 * This function generates an opponent name for use in displaying of the game schedules
		 * 
		 * @param JLTeam $context
		 * @param JLGame $game
		 * @return string
		 */
		function getOpponent(JLTeam $context, JLGame $game) {
			$teamid = $context->getId();
			if ($game->getAwayteamId() == $teamid) {
				return "@ " . $game->getHometeam();
			} else {
				return $game->getAwayteam();
			}
		}
		
		
		/**
		 * This function generates an opponent name for use in displaying of the game schedules
		 *
		 * @param JLTeam $context
		 * @param JLGame $game
		 * @return string
		 */
		function getOpponentLogo(JLTeam $context, JLGame $game) {
			$teamid = $context->getId();
			if ($game->getAwayteamId() == $teamid) {
				$logo = $game->getHometeamLogo();
				if ($logo == null) {
					return "default-logo.jpg";
				} else {
					return $logo;
				}
			} 
			if ($game->getHometeamId() == $teamid) {
				$logo = $game->getAwayteamLogo();
				if ($logo == null) {
					return "default-logo.jpg";
				} else {
					return $logo;
				}
			}
			return "default-logo.jpg";
		}
		
		/**
		 * This function will bind an EDIT request from this view to the TEAM object.
		 *
		 * @param JLTeam $team
		 * @return not applicable
		 */
		function bindRequest(JLTeam &$team) {
			
			$req = fsRequest::getInstance();
			$team->setId($req->getValue('teamid','0'));
			$team->setName($req->getValue('teamname',''));
			$team->setWebsite($req->getValue('website',''));
			$team->setCity($req->getValue('city',''));
			$team->setState($req->getValue('state',''));
			$team->setOwnerId($req->getValue('ownerid',''));
			$team->setHomeField($req->getValue('fieldname'));
			$team->setFieldDirections($req->getValue('fielddirections'));
			$team->setFieldLatitude($req->getValue('fieldlatitude'));
			$team->setFieldLongitude($req->getValue('fieldlongitude'));
			$team->setFieldAddress($req->getValue('fieldaddress'));
			$team->setCoachName($req->getValue('coachname'));
			$team->setCoachEmail($req->getValue('coachemail'));
			$team->setCoachPhone($req->getValue('coachphone'));
			foreach ($team->getCustomFields() as $field) {
				if ($field instanceof fsField) {
	// 				echo "Value [" . $field->getKeycode() . " = " . $req->getValue($field->getKeycode());
					$field->setValue($req->getValue($field->getKeycode()));
					$team->setField($field);
				}
			}
		}
		
		function bindRequestToGameObject() {
			
			$req = fsRequest::getInstance();
			
			$svc = &JLTeamService::getInstance();
			$insert = false;
			
			$game = new JLGame();
	
			if (isset($_REQUEST["id"])) {
				$game->setId($_REQUEST["id"]);
				if ($game->getId() == 0) {
					$insert = true;
				}
			} else {
				$game->setId(0);
				$insert = true;
			}
	
	//		$game->setDivisionId($req->getValue("division_id"));
			
			if (isset($_REQUEST["division_id"])) {
				$game->setDivisionId($_REQUEST["division_id"]);
			} else {
				throw new Exception(JLText::getText('JL_UNKNOWN_DIVISION_ID'));
			}
			if (isset($_REQUEST["season_id"])) {
				$game->setSeason($_REQUEST["season_id"]);
			} else {
				throw new Exception(JLText::getText('JL_UNKNOWN_SEASON_ID'));
			}
			
			if (isset($_REQUEST["gamedate"])) {
				$game->setGameDate($_REQUEST["gamedate"]);
			} else {
				throw new Exception(JLText::getText('JL_MISSING_GAMEDATE'));
			}
			
			if (isset($_REQUEST["conference_game"])) {
				$game->setConferenceGame($_REQUEST["conference_game"]);
			} else {
				throw new Exception(JLText::getText('JL_MISSING_CONFGAME_INDICATOR'));
			}
			
			if (isset($_REQUEST['cb_league_hometeam'])) {
				if ($_REQUEST['cb_league_hometeam']  == "on") {
					$game->setHomeLeagueFlag("Y");
				} else {
					$game->setHomeLeagueFlag("N");
				}
			} else {
				$game->setHomeLeagueFlag("N");
			}
			if (isset($_REQUEST['cb_league_awayteam'])) {
				if ($_REQUEST['cb_league_awayteam']  == "on") {
					$game->setAwayLeagueFlag("Y");
				} else {
					$game->setAwayLeagueFlag("N");
				}
			} else {
				$game->setAwayLeagueFlag("N");
			}
			if (isset($_REQUEST["hometeam_name"])) {
				$game->setHometeam($_REQUEST["hometeam_name"]);
			}
			
			if (isset($_REQUEST["hometeam_id"])) {
				$game->setHometeamId($_REQUEST["hometeam_id"]);
				if ($insert) {
					try {
						$t = $svc->getRow($_REQUEST["hometeam_id"]);
						$game->setHometeam($t->getName());
					} catch (Exception $e) {
						// do nothing
					}
				}
			}
			if (isset($_REQUEST["awayteam_name"])) {
				$game->setAwayteam($_REQUEST["awayteam_name"]);
			}
			if (isset($_REQUEST["awayteam_id"])) {
				$game->setAwayteamId($_REQUEST["awayteam_id"]);
				if ($insert) {
					try {
						$t = $svc->getRow($_REQUEST["awayteam_id"]);
						$game->setAwayteam($t->getName());
					} catch (Exception $e) {
						// do nothing
					}
				}
			}
			
			if (isset($_REQUEST["hometeam_score"])) {
				$game->setHometeamScore($_REQUEST["hometeam_score"]);
			} else {
				$game->setHometeamScore(0);
			}
			
			if (isset($_REQUEST["awayteam_score"])) {
				$game->setAwayteamScore($_REQUEST["awayteam_score"]);
			} else {
				$game->setAwayteamScore(0);
			}
			
			if (isset($_REQUEST["location"])) {
				$game->setLocation($_REQUEST["location"]);
			}
			if (isset($_REQUEST["highlights"])) {
				$game->setHighlights($_REQUEST["highlights"]);
			}
			if (isset($_REQUEST["gamestatus_sl"])) {
				$game->setGameStatus($_REQUEST["gamestatus_sl"]);
			} else {
				if (isset($_REQUEST["gamestatus"])) {
					$game->setGameStatus($_REQUEST["gamestatus"]);
				}
			}
			if (isset($_REQUEST["gametime"])) {
				$game->setGameTime($_REQUEST["gametime"]);
			}
			if (isset($_REQUEST["shortgame"])) {
				$game->setShortgame($_REQUEST["shortgame"]);
			}
			return $game;
			
		}
		
		/**
		 * This function will return a string ("W","L") for a given game of the team being
		 * viewed. 
		 * 
		 * @param unknown $context
		 * @param JLGame $game
		 * @return string
		 */
		function getWinLoss($context, JLGame $game) {
			$winloss = " ";
			if ($context instanceof JLTeam) {
				$teamid = $context->getId();
			} else {
				$teamid = $context;
			}
			$hometeam = false;
			//		echo "HOMETEAM ID = " . $game->getHometeamId() ;
			//		echo "TEAMID = " . $teamid;
			if ($game->getHometeamId() == $teamid) {
				$hometeam = true;
			}
			$winloss = "-";
			if ($game->isComplete()) {
				if ($game->getHometeamScore() == $game->getAwayteamScore()) {
					return "T";
				}
				
				if ($hometeam) {
					if ($game->getHometeamScore() > $game->getAwayteamScore()) {
						$winloss = "W";
					} else {
						$winloss = "L";
					}
				} else {
					if ($game->getHometeamScore() > $game->getAwayteamScore()) {
						$winloss = "L";
					} else {
						$winloss = "W";
					}
				}
			}
			return $winloss;
		}
		
		/**
		 * This function will format the game score based on the "W" or "L" of the context of
		 * the team currently being viewed.
		 * @param unknown $context
		 * @param JLGame $game
		 * @return string
		 */
		function getGameScore($context, JLGame $game) {
			$winloss = $this->getWinLoss($context, $game);
			switch ($winloss) {
				case "W":
					if ($game->getHometeamScore() > $game->getAwayteamScore()) {
						return $game->getHometeamScore() . "-" . $game->getAwayteamScore();
					} else {
						return $game->getAwayteamScore() . "-" . $game->getHometeamScore();
					}
					break;
				case 'L';
				if ($game->getHometeamScore() > $game->getAwayteamScore()) {
					return $game->getAwayteamScore() . "-" . $game->getHometeamScore();
				} else {
					return $game->getHometeamScore() . "-" . $game->getAwayteamScore();
				}
				break;
				default:
					return $game->getHometeamScore() . "-" . $game->getAwayteamScore();
			}
		}
		
		
		/**
		 * This function will return the HMTL string for the most recent game
		 * @param JLTeam $context
		 * @param JLGame $game
		 * @return string
		 */
		function getMostRecentGame(JLTeam $context, JLGame $game = null) {
			if ($game == null) {
				$html = "<span style=\"font-weight: none; font-size: 12px;\">Last Game</span><br/>";
				$html .= "No Game information available";
				return $html;
			}
			$teamid = $context->getId();
			$hometeam = false;
			if ($game->getHometeamId() == $teamid) {
				$hometeam = true;
			}
			$winloss = $this->getWinLoss($context, $game);
			if ($hometeam) {
				$opponent = $game->getAwayteam();
			} else {
				$opponent = $game->getHometeam();
			}
			$html = "<span style=\"font-weight: none; font-size: 12px;\">Last Game - " . $game->getGameDate() . "</span><br/>";
			$html .= "(" . $winloss .") vs. " . $opponent . " ";
			$html .= $game->getHometeamScore() . " - " . $game->getAwayteamScore();
			return $html;
		}
		
		/**
		 * This function will return an HTML string of upcoming games
		 * 
		 * @param JLTeam $context
		 * @param array $games
		 * @return string
		 */
		function getUpcomingGames(JLTeam $context, array $games = null) {
			$html = "";
			if (sizeof($games)==0) {
				$html = "No upcoming games scheduled";
				return $html;
			}
			$html = "<table class='teamprofile-upcoming-games'>";
			foreach ($games as $game) {
				if ($game instanceof JLGame ) {
					$html .= "<tr>";
					$html .= "<td>" . $game->getGameDate() . "</td>";
					$html .= "<td>" . self::getOpponent($JLTeam, $game) . "</td>"; // @TODO:  May need to strip all "@" from the response
					$html .= "</tr>";
				}
			}
			$html .= "</table>";
		
			/*
				$teamid = $context->getId();
			$hometeam = false;
			if ($game->getHometeamId() == $teamid) {
			$ind = "";
			$hometeam = true;
			} else {
			$ind = "@";
			}
			if ($hometeam) {
			$oppid = $game->getAwayteamId();
			}
			$tmpl = new JLTemplate("teamprofile.upcominggame");
			$tmpl->setObject('game',$game);
			*/
		}
		
		
		function displayPrivateField($field) {
			if ($this->seePrivateFields) {
				return $field;
			} else {
				return "Unavailable";
			}
		}
		
		function getIssuesHtml(array $issues) {
			$html = "";
			foreach ($issues as $issue) {
				$html .= "<strong>Warning!</strong> " . $issue . "<br/>";
			}
			return $html;
		}
	
	}