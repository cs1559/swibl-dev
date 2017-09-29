<?php

class fsResponsiveHtml {
	
	static function renderSelectList(fsSelectList $list, $width) {
/*
				<div class="form-group">
					<label class="col-sm-3 control-label" for="league-game-group">Game Type:</label>
				  <div id="league-game-group" class="btn-group" data-toggle="buttons">
				    <label class="btn btn-default">
				      <input name="conference_game" id="rb-league-game" type="radio" value="Y"> League Game
				    </label>
				    <label class="btn btn-default">
				      <input name="conference_game" id="rb-nonleague-game" type="radio" value="N"> Non-League
				    </label>
				  </div>
				</div>
				
						$le = $this->lineEnd;
		$this->setContent(" ");
		if ($this->disabled) {
			$this->setAttribute("disabled", null);
		}
		$html = $this->getStartTag() . $le;
		if ($this->header != null) {
			$html .= "<option value=\"\">" . $this->header . "</option>" . $le;
		}
		foreach ($this->options as $option) {			
				$html .= $option->toHtml() . $le;
		}
		$html .= "</select>" . $le;
		return $html;
 * 
 * 
 */		
		$id = $list->getId();
		$name = $list->getName();
		
		$html = "<div id=\"" . $id . "-group\" class=\"btn-group\" data-toggle=\"buttons\">";

		foreach ($list->options as $option) {
			$html .= "<label class=\"btn btn-default\">";
			$html .= "<input name=\"" . $name . " id=\"rb-" . $id . "\" type=\"radio\" value=\"" . $option->getValue() . "\">" . $option->getText();
			$html .= "</label>";
		}
		$html .= "</div>";
		
	}
}

