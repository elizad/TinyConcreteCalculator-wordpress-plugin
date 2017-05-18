<?php
/*
Plugin Name: Tiny Concrete Calculator
Description: Calculates amount of material needed to cover square unit to a given depth. Use shortcode [ConcreteCalculator]. When the user enters dimensions, calculator will return results in metric and yards rounded up to whole number.
Author:  E.Dascal
Version: 1.0
Author URI: http://tinyconcretecalculator.pheonix-soft.com
*/

// Add calculator function
wp_enqueue_script('concrete_calculator', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array('jquery'));

function get_ConcreteCalculator($ConcreteCalculator) {
	return '	<table>
	<thead> 
	     <h2> Concrete Calculator</h2>
         <p>The calculator will estimate the rounded up number of cubic unit of volume required for a pour or placement.</p>
	</thead>
    <tr>
        <td>Length</td>
        <td>
            <input name="volLength" type="number" id="nrLength" value="1" pattern="^[1-9]\\d*$" min="1"/>
		</td>        <td>
            <select name="volLengthUnit" id="volumeLengthUnit">
			        <option value="1">Metres</option>
					<option value="0.01">Centimetres</option>
					<option value="0.0254">Inches</option>
					<option value="0.3048">Feet</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Width</td>
        <td>
            <input name="volWidth" type="number" id="nrWidth" value="1" pattern="^[1-9]\\d*$" min="1"/>
		</td>
        <td>	
            <select name="volWidthUnit" id="volumeWidthUnit">
				<option value="1">Metres</option>
				<option value="0.01">Centimetres</option>
				<option value="0.0254">Inches</option>
				<option value="0.3048">Feet</option>
			</select>
        </td>
    </tr>
    <tr>
        <td>Thickness</td>
        <td>
            <input name="volThickness" type="number" id="nrThickness" value="1" pattern="^[1-9]\\d*$" min="1"/>
	    </td>
        <td>		
            <select name="volThicknessUnit" id="volumeThicknessUnit">
				<option value="1">Metres</option>
				<option value="0.01">Centimetres</option>
				<option value="0.0254">Inches</option>
				<option value="0.3048">Feet</option>
			</select>
        </td>
    </tr>
	<tr> 	    <td style="border:none;"> </td>		<td style="border:none;"> </td>        <td style="border:none;"> <b><a id="bnCalculate" class="btn button"  style="float:right;"      href="javascript:CalculateVolume();">Calculate</a></b>		</td>
    </tr>		
    <tr style="border:none;">	    <td style="border:none;"> </td>
        <td style="border:none;">Volume (metric):</td>
        <td style="border:none;"><span id="lblMetricAnswer"> --- </span></td>
    </tr>
    <tr style="border:none;">	    <td style="border:none;"> </td>
        <td style="border:none;">Volume (yards):</td>
        <td style="border:none;"><span id="lblImperialAnswer"> --- </span></td>
    </tr>
</table>
<script language="javascript" type="text/javascript">
    function CalculateVolume() {
        var length = parseFloat($("#nrLength").val());
        var thickness = parseFloat($("#nrThickness").val());
        var width = parseFloat($("#nrWidth").val());
        var lengthUnit = parseFloat($("#volumeLengthUnit").val());
        var thicknessUnit = parseFloat($("#volumeThicknessUnit").val());
        var widthUnit = parseFloat($("#volumeWidthUnit").val());
        if (isNaN(length) || isNaN(width) || isNaN(thickness)) {
            alert("Please enter numeric values only");
        }
        else {
            var metricAnswer = Math.round(((length * lengthUnit) * (width * widthUnit) * (thickness * thicknessUnit)) * 10000) / 10000;
            $("#lblMetricAnswer").html(metricAnswer + " cu. metric.");
            var imperialAnswer = Math.round((metricAnswer * 1.30795062) * 10000) / 10000;
            $("#lblImperialAnswer").html(imperialAnswer + " cu. yd.");
        }
    }
</script>';
}
//Add shortcode
add_shortcode('ConcreteCalculator', 'get_ConcreteCalculator');
?>