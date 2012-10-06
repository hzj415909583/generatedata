<?php


class DataType_AlphaNumeric extends DataTypePlugin {

	protected $dataTypeName = "Alphanumeric";
	protected $hasHelpDialog = true;
	protected $dataTypeFieldGroup = "numeric";
	protected $dataTypeFieldGroupOrder = 10;
	protected $jsModules = array("AlphaNumeric.js");

	private $helpDialogWidth = 460;


	public function generateItem($row, $placeholderStr, $existingRowData) {
		$formats = explode("|", $placeholderStr);
		$chosenFormat = $formats[0];
		if (count($formats) > 1) {
			$chosenFormat = $formats[rand(0, count($formats)-1)];
		}
		return Utils::generateRandomAlphanumericStr($chosenFormat);
	}

	public function getExportTypeInfo($exportType, $options) {
		$info = "";
		switch ($exportType) {
			case "sql":
				$info = "varchar(255)";
				break;
		}
		return $info;
	}

	public function getTemplateOptions($postdata, $col, $num_cols) {
		if (!isset($postdata["option_$col"]) || empty($postdata["option_$col"])) {
			return false;
		}
		return $postdata["option_$col"];
	}

	public function getExampleColumnHTML() {
		$L = Core::$language->getCurrentLanguageStrings();
		$html =<<< END
	<select name="dtExample_%ROW%" id="dtExample_%ROW%">
		<option value="">{$L["please_select"]}</option>
		<option value="LxL xLx">V6M 4C1 {$this->L["AlphaNumeric_example_CanPostalCode"]}</option>
		<option value="xxxxx">90210 {$this->L["AlphaNumeric_example_USZipCode"]}</option>
		<option value="LLLxxLLLxLL">eZg29gdF5K1 {$this->L["AlphaNumeric_example_Password"]}</option>
	</select>
END;
		return $html;
	}

	public function getOptionsColumnHTML() {
		return '<input type="text" name="dtOption_%ROW%" id="dtOption_%ROW%" style="width: 267px" />';
	}

	public function getHelpDialogInfo() {
		$L = Core::$language->getCurrentLanguageStrings();
		$content =<<<EOF
			<p>
				{$this->L["AlphaNumeric_help_intro"]}
			</p>

			<table cellpadding="0" cellspacing="1" width="100%">
			<tr>
				<td width="20"><h4>L</h4></td>
				<td width="200">{$this->L["AlphaNumeric_help_1"]}</td>
				<td width="20"><h4>V</h4></td>
				<td>{$this->L["AlphaNumeric_help_2"]}</td>
			</tr>
			<tr>
				<td><h4>l</h4></td>
				<td>{$this->L["AlphaNumeric_help_3"]}</td>
				<td><h4>v</h4></td>
				<td>{$this->L["AlphaNumeric_help_4"]}</td>
			</tr>
			<tr>
				<td><h4>D</h4></td>
				<td>{$this->L["AlphaNumeric_help_5"]}</td>
				<td><h4>F</h4></td>
				<td>{$this->L["AlphaNumeric_help_6"]}</td>
			</tr>
			<tr>
				<td><h4>C</h4></td>
				<td>{$this->L["AlphaNumeric_help_7"]}</td>
				<td><h4>x</h4></td>
				<td>{$this->L["AlphaNumeric_help_8"]}</td>
			</tr>
			<tr>
				<td><h4>c</h4></td>
				<td>{$this->L["AlphaNumeric_help_9"]}</td>
				<td><h4>X</h4></td>
				<td>{$this->L["AlphaNumeric_help_10"]}</td>
			</tr>
			<tr>
				<td><h4>E</h4></td>
				<td>{$this->L["AlphaNumeric_help_11"]}</td>
				<td><h4>H</h4></td>
				<td>{$this->L["AlphaNumeric_help_12"]}</td>
			</tr>
			</table>
EOF;

		return array(
			"dialogWidth" => $this->helpDialogWidth,
			"content"     => $content
		);
	}
}