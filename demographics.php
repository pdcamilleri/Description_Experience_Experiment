<?php
//This code checks that the user came via the homepage, and redicts if not
session_start();
seenHomepage();
function seenHomepage() {
    if (!isset($_SESSION['homepage_visit']) || $_SESSION['homepage_visit'] != true) {
        header("Location: http://www.adriancamilleri.net/Exp11a/");
    } else {
        return true;
    }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <title>Decision-making Game</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />

    <!-- javascript to check that all information is given on the demographics page -->
    <script type="text/javascript" src="js/demographics.js"></script>
</head>

<!-- HTML-->
<body>
  <div id="container">
    <form id="DemographicsForm" name="DemographicsForm" method="post" action="DEF.php" onsubmit="return checkAnswers()">
      <p class="emphasize">Demographics</p>

      <p>Please fill in your demographic details below.</p>

      <table class="center">
        <tr>
          <td><label for="Residence">In what country do you live?</label>
          </td>
        </tr>
        <tr>  
          <td><select id="Residence" name="Residence" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="Afghanistan">
              Afghanistan
            </option>

            <option value="Akrotiri">
              Akrotiri
            </option>

            <option value="Albania">
              Albania
            </option>

            <option value="Algeria">
              Algeria
            </option>

            <option value="American Samoa">
              American Samoa
            </option>

            <option value="Andorra">
              Andorra
            </option>

            <option value="Angola">
              Angola
            </option>

            <option value="Anguilla">
              Anguilla
            </option>

            <option value="Antarctica">
              Antarctica
            </option>

            <option value="Antigua and Barbuda">
              Antigua and Barbuda
            </option>

            <option value="Argentina">
              Argentina
            </option>

            <option value="Armenia">
              Armenia
            </option>

            <option value="Aruba">
              Aruba
            </option>

            <option value="Ashmore and Cartier Islands">
              Ashmore and Cartier Islands
            </option>

            <option value="Australia">
              Australia
            </option>

            <option value="Austria">
              Austria
            </option>

            <option value="Azerbaijan">
              Azerbaijan
            </option>

            <option value="Bahamas">
              Bahamas, The
            </option>

            <option value="Bahrain">
              Bahrain
            </option>

            <option value="Bangladesh">
              Bangladesh
            </option>

            <option value="Barbados">
              Barbados
            </option>

            <option value="Bassas da India">
              Bassas da India
            </option>

            <option value="Belarus">
              Belarus
            </option>

            <option value="Belgium">
              Belgium
            </option>

            <option value="Belize">
              Belize
            </option>

            <option value="Benin">
              Benin
            </option>

            <option value="Bermuda">
              Bermuda
            </option>

            <option value="Bhutan">
              Bhutan
            </option>

            <option value="Bolivia">
              Bolivia
            </option>

            <option value="Bosnia and Herzegovina">
              Bosnia and Herzegovina
            </option>

            <option value="Botswana">
              Botswana
            </option>

            <option value="Bouvet Island">
              Bouvet Island
            </option>

            <option value="Brazil">
              Brazil
            </option>

            <option value="British Indian Ocean Territory">
              British Indian Ocean Territory
            </option>

            <option value="British Virgin Islands">
              British Virgin Islands
            </option>

            <option value="Brunei">
              Brunei
            </option>

            <option value="Bulgaria">
              Bulgaria
            </option>

            <option value="Burkina Faso">
              Burkina Faso
            </option>

            <option value="Burma">
              Burma
            </option>

            <option value="Burundi">
              Burundi
            </option>

            <option value="Cambodia">
              Cambodia
            </option>

            <option value="Cameroon">
              Cameroon
            </option>

            <option value="Canada">
              Canada
            </option>

            <option value="Cape Verde">
              Cape Verde
            </option>

            <option value="Cayman Islands">
              Cayman Islands
            </option>

            <option value="Central African Republic">
              Central African Republic
            </option>

            <option value="Chad">
              Chad
            </option>

            <option value="Chile">
              Chile
            </option>

            <option value="China">
              China
            </option>

            <option value="Christmas Island">
              Christmas Island
            </option>

            <option value="Clipperton Island">
              Clipperton Island
            </option>

            <option value="Cocos (Keeling) Islands">
              Cocos (Keeling) Islands
            </option>

            <option value="Colombia">
              Colombia
            </option>

            <option value="Comoros">
              Comoros
            </option>

            <option value="Congo Democratic Republic of the">
              Congo, Democratic Republic of the
            </option>

            <option value="Congo Republic of the">
              Congo, Republic of the
            </option>

            <option value="Cook Islands">
              Cook Islands
            </option>

            <option value="Coral Sea Islands">
              Coral Sea Islands
            </option>

            <option value="Costa Rica">
              Costa Rica
            </option>

            <option value="Cote d'Ivoire">
              Cote d'Ivoire
            </option>

            <option value="Croatia">
              Croatia
            </option>

            <option value="Cuba">
              Cuba
            </option>

            <option value="Cyprus">
              Cyprus
            </option>

            <option value="Czech Republic">
              Czech Republic
            </option>

            <option value="Denmark">
              Denmark
            </option>

            <option value="Dhekelia">
              Dhekelia
            </option>

            <option value="Djibouti">
              Djibouti
            </option>

            <option value="Dominica">
              Dominica
            </option>

            <option value="Dominican Republic">
              Dominican Republic
            </option>

            <option value="Ecuador">
              Ecuador
            </option>

            <option value="Egypt">
              Egypt
            </option>

            <option value="El Salvador">
              El Salvador
            </option>

            <option value="Equatorial Guinea">
              Equatorial Guinea
            </option>

            <option value="Eritrea">
              Eritrea
            </option>

            <option value="Estonia">
              Estonia
            </option>

            <option value="Ethiopia">
              Ethiopia
            </option>

            <option value="Europa Island">
              Europa Island
            </option>

            <option value="Falkland Islands (Islas Malvinas)">
              Falkland Islands (Islas Malvinas)
            </option>

            <option value="Faroe Islands">
              Faroe Islands
            </option>

            <option value="Fiji">
              Fiji
            </option>

            <option value="Finland">
              Finland
            </option>

            <option value="France">
              France
            </option>

            <option value="French Guiana">
              French Guiana
            </option>

            <option value="French Polynesia">
              French Polynesia
            </option>

            <option value="French Southern and Antarctic Lands">
              French Southern and Antarctic Lands
            </option>

            <option value="Gabon">
              Gabon
            </option>

            <option value="Gambia The">
              Gambia, The
            </option>

            <option value="Gaza Strip">
              Gaza Strip
            </option>

            <option value="Georgia">
              Georgia
            </option>

            <option value="Germany">
              Germany
            </option>

            <option value="Ghana">
              Ghana
            </option>

            <option value="Gibraltar">
              Gibraltar
            </option>

            <option value="Glorioso Islands">
              Glorioso Islands
            </option>

            <option value="Greece">
              Greece
            </option>

            <option value="Greenland">
              Greenland
            </option>

            <option value="Grenada">
              Grenada
            </option>

            <option value="Guadeloupe">
              Guadeloupe
            </option>

            <option value="Guam">
              Guam
            </option>

            <option value="Guatemala">
              Guatemala
            </option>

            <option value="Guernsey">
              Guernsey
            </option>

            <option value="Guinea">
              Guinea
            </option>

            <option value="Guinea-Bissau">
              Guinea-Bissau
            </option>

            <option value="Guyana">
              Guyana
            </option>

            <option value="Haiti">
              Haiti
            </option>

            <option value="Heard Island and McDonald Islands">
              Heard Island and McDonald Islands
            </option>

            <option value="Holy See (Vatican City)">
              Holy See (Vatican City)
            </option>

            <option value="Honduras">
              Honduras
            </option>

            <option value="Hong Kong">
              Hong Kong
            </option>

            <option value="Hungary">
              Hungary
            </option>

            <option value="Iceland">
              Iceland
            </option>

            <option value="India">
              India
            </option>

            <option value="Indonesia">
              Indonesia
            </option>

            <option value="Iran">
              Iran
            </option>

            <option value="Iraq">
              Iraq
            </option>

            <option value="Ireland">
              Ireland
            </option>

            <option value="Isle of Man">
              Isle of Man
            </option>

            <option value="Israel">
              Israel
            </option>

            <option value="Italy">
              Italy
            </option>

            <option value="Jamaica">
              Jamaica
            </option>

            <option value="Jan Mayen">
              Jan Mayen
            </option>

            <option value="Japan">
              Japan
            </option>

            <option value="Jersey">
              Jersey
            </option>

            <option value="Jordan">
              Jordan
            </option>

            <option value="Juan de Nova Island">
              Juan de Nova Island
            </option>

            <option value="Kazakhstan">
              Kazakhstan
            </option>

            <option value="Kenya">
              Kenya
            </option>

            <option value="Kiribati">
              Kiribati
            </option>

            <option value="Korea North">
              Korea, North
            </option>

            <option value="Korea South">
              Korea, South
            </option>

            <option value="Kuwait">
              Kuwait
            </option>

            <option value="Kyrgyzstan">
              Kyrgyzstan
            </option>

            <option value="Laos">
              Laos
            </option>

            <option value="Latvia">
              Latvia
            </option>

            <option value="Lebanon">
              Lebanon
            </option>

            <option value="Lesotho">
              Lesotho
            </option>

            <option value="Liberia">
              Liberia
            </option>

            <option value="Libya">
              Libya
            </option>

            <option value="Liechtenstein">
              Liechtenstein
            </option>

            <option value="Lithuania">
              Lithuania
            </option>

            <option value="Luxembourg">
              Luxembourg
            </option>

            <option value="Macau">
              Macau
            </option>

            <option value="Macedonia">
              Macedonia
            </option>

            <option value="Madagascar">
              Madagascar
            </option>

            <option value="Malawi">
              Malawi
            </option>

            <option value="Malaysia">
              Malaysia
            </option>

            <option value="Maldives">
              Maldives
            </option>

            <option value="Mali">
              Mali
            </option>

            <option value="Malta">
              Malta
            </option>

            <option value="Marshall Islands">
              Marshall Islands
            </option>

            <option value="Martinique">
              Martinique
            </option>

            <option value="Mauritania">
              Mauritania
            </option>

            <option value="Mauritius">
              Mauritius
            </option>

            <option value="Mayotte">
              Mayotte
            </option>

            <option value="Mexico">
              Mexico
            </option>

            <option value="Micronesia Federated States of">
              Micronesia, Federated States of
            </option>

            <option value="Moldova">
              Moldova
            </option>

            <option value="Monaco">
              Monaco
            </option>

            <option value="Mongolia">
              Mongolia
            </option>

            <option value="Montserrat">
              Montserrat
            </option>

            <option value="Morocco">
              Morocco
            </option>

            <option value="Mozambique">
              Mozambique
            </option>

            <option value="Namibia">
              Namibia
            </option>

            <option value="Nauru">
              Nauru
            </option>

            <option value="Navassa Island">
              Navassa Island
            </option>

            <option value="Nepal">
              Nepal
            </option>

            <option value="Netherlands">
              Netherlands
            </option>

            <option value="Netherlands Antilles">
              Netherlands Antilles
            </option>

            <option value="New Caledonia">
              New Caledonia
            </option>

            <option value="New Zealand">
              New Zealand
            </option>

            <option value="Nicaragua">
              Nicaragua
            </option>

            <option value="Niger">
              Niger
            </option>

            <option value="Nigeria">
              Nigeria
            </option>

            <option value="Niue">
              Niue
            </option>

            <option value="Norfolk Island">
              Norfolk Island
            </option>

            <option value="Northern Mariana Islands">
              Northern Mariana Islands
            </option>

            <option value="Norway">
              Norway
            </option>

            <option value="Oman">
              Oman
            </option>

            <option value="Pakistan">
              Pakistan
            </option>

            <option value="Palau">
              Palau
            </option>

            <option value="Panama">
              Panama
            </option>

            <option value="Papua New Guinea">
              Papua New Guinea
            </option>

            <option value="Paracel Islands">
              Paracel Islands
            </option>

            <option value="Paraguay">
              Paraguay
            </option>

            <option value="Peru">
              Peru
            </option>

            <option value="Philippines">
              Philippines
            </option>

            <option value="Pitcairn Islands">
              Pitcairn Islands
            </option>

            <option value="Poland">
              Poland
            </option>

            <option value="Portugal">
              Portugal
            </option>

            <option value="Puerto Rico">
              Puerto Rico
            </option>

            <option value="Qatar">
              Qatar
            </option>

            <option value="Reunion">
              Reunion
            </option>

            <option value="Romania">
              Romania
            </option>

            <option value="Russia">
              Russia
            </option>

            <option value="Rwanda">
              Rwanda
            </option>

            <option value="Saint Helena">
              Saint Helena
            </option>

            <option value="Saint Kitts and Nevis">
              Saint Kitts and Nevis
            </option>

            <option value="Saint Lucia">
              Saint Lucia
            </option>

            <option value="Saint Pierre and Miquelon">
              Saint Pierre and Miquelon
            </option>

            <option value="Saint Vincent and the Grenadines">
              Saint Vincent and the Grenadines
            </option>

            <option value="Samoa">
              Samoa
            </option>

            <option value="San Marino">
              San Marino
            </option>

            <option value="Sao Tome and Principe">
              Sao Tome and Principe
            </option>

            <option value="Saudi Arabia">
              Saudi Arabia
            </option>

            <option value="Senegal">
              Senegal
            </option>

            <option value="Serbia and Montenegro">
              Serbia and Montenegro
            </option>

            <option value="Seychelles">
              Seychelles
            </option>

            <option value="Sierra Leone">
              Sierra Leone
            </option>

            <option value="Singapore">
              Singapore
            </option>

            <option value="Slovakia">
              Slovakia
            </option>

            <option value="Slovenia">
              Slovenia
            </option>

            <option value="Solomon Islands">
              Solomon Islands
            </option>

            <option value="Somalia">
              Somalia
            </option>

            <option value="South Africa">
              South Africa
            </option>

            <option value="South Georgia and the South Sandwich Islands">
              South Georgia and the South Sandwich Islands
            </option>

            <option value="Spain">
              Spain
            </option>

            <option value="Spratly Islands">
              Spratly Islands
            </option>

            <option value="Sri Lanka">
              Sri Lanka
            </option>

            <option value="Sudan">
              Sudan
            </option>

            <option value="Suriname">
              Suriname
            </option>

            <option value="Svalbard">
              Svalbard
            </option>

            <option value="Swaziland">
              Swaziland
            </option>

            <option value="Sweden">
              Sweden
            </option>

            <option value="Switzerland">
              Switzerland
            </option>

            <option value="Syria">
              Syria
            </option>

            <option value="Taiwan">
              Taiwan
            </option>

            <option value="Tajikistan">
              Tajikistan
            </option>

            <option value="Tanzania">
              Tanzania
            </option>

            <option value="Thailand">
              Thailand
            </option>

            <option value="Timor-Leste">
              Timor-Leste
            </option>

            <option value="Togo">
              Togo
            </option>

            <option value="Tokelau">
              Tokelau
            </option>

            <option value="Tonga">
              Tonga
            </option>

            <option value="Trinidad and Tobago">
              Trinidad and Tobago
            </option>

            <option value="Tromelin Island">
              Tromelin Island
            </option>

            <option value="Tunisia">
              Tunisia
            </option>

            <option value="Turkey">
              Turkey
            </option>

            <option value="Turkmenistan">
              Turkmenistan
            </option>

            <option value="Turks and Caicos Islands">
              Turks and Caicos Islands
            </option>

            <option value="Tuvalu">
              Tuvalu
            </option>

            <option value="Uganda">
              Uganda
            </option>

            <option value="Ukraine">
              Ukraine
            </option>

            <option value="United Arab Emirates">
              United Arab Emirates
            </option>

            <option value="United Kingdom">
              United Kingdom
            </option>

            <option value="United States">
              United States
            </option>

            <option value="Uruguay">
              Uruguay
            </option>

            <option value="Uzbekistan">
              Uzbekistan
            </option>

            <option value="Vanuatu">
              Vanuatu
            </option>

            <option value="Venezuela">
              Venezuela
            </option>

            <option value="Vietnam">
              Vietnam
            </option>

            <option value="Virgin Islands">
              Virgin Islands
            </option>

            <option value="Wake Island">
              Wake Island
            </option>

            <option value="Wallis and Futuna">
              Wallis and Futuna
            </option>

            <option value="West Bank">
              West Bank
            </option>

            <option value="Western Sahara">
              Western Sahara
            </option>

            <option value="Yemen">
              Yemen
            </option>

            <option value="Zambia">
              Zambia
            </option>

            <option value="Zimbabwe">
              Zimbabwe
            </option>
          </select></td>
        </tr>

        <tr>
          <td><label for="Gender">What is your gender?</label> 
          </td>
        </tr>
        <tr>  
          <td><select id="Gender" name="Gender" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="1">
              Male
            </option>

            <option value="2">
              Female
            </option>
          </select></td>
        </tr>

        <tr>
          <td><label for="Age">What is your age?</label> 
          </td>
        </tr>
        <tr>  
          <td><select id="Age" name="Age" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="18">
              18
            </option>

            <option value="19">
              19
            </option>

            <option value="20">
              20
            </option>

            <option value="21">
              21
            </option>

            <option value="22">
              22
            </option>

            <option value="23">
              23
            </option>

            <option value="24">
              24
            </option>

            <option value="25">
              25
            </option>

            <option value="26">
              26
            </option>

            <option value="27">
              27
            </option>

            <option value="28">
              28
            </option>

            <option value="29">
              29
            </option>

            <option value="30">
              30
            </option>

            <option value="31">
              31
            </option>

            <option value="32">
              32
            </option>

            <option value="33">
              33
            </option>

            <option value="34">
              34
            </option>

            <option value="35">
              35
            </option>

            <option value="36">
              36
            </option>

            <option value="37">
              37
            </option>

            <option value="38">
              38
            </option>

            <option value="39">
              39
            </option>

            <option value="40">
              40
            </option>

            <option value="41">
              41
            </option>

            <option value="42">
              42
            </option>

            <option value="43">
              43
            </option>

            <option value="44">
              44
            </option>

            <option value="45">
              45
            </option>

            <option value="46">
              46
            </option>

            <option value="47">
              47
            </option>

            <option value="48">
              48
            </option>

            <option value="49">
              49
            </option>

            <option value="50">
              50
            </option>

            <option value="51">
              51
            </option>

            <option value="52">
              52
            </option>

            <option value="53">
              53
            </option>

            <option value="54">
              54
            </option>

            <option value="55">
              55
            </option>

            <option value="56">
              56
            </option>

            <option value="57">
              57
            </option>

            <option value="58">
              58
            </option>

            <option value="59">
              59
            </option>

            <option value="60">
              60
            </option>

            <option value="61">
              61
            </option>

            <option value="62">
              62
            </option>

            <option value="63">
              63
            </option>

            <option value="64">
              64
            </option>

            <option value="65">
              65
            </option>

            <option value="66">
              66
            </option>

            <option value="67">
              67
            </option>

            <option value="68">
              68
            </option>

            <option value="69">
              69
            </option>

            <option value="70">
              70
            </option>

            <option value="71">
              71
            </option>

            <option value="72">
              72
            </option>

            <option value="73">
              73
            </option>

            <option value="74">
              74
            </option>

            <option value="75">
              75
            </option>

            <option value="76">
              76
            </option>

            <option value="77">
              77
            </option>

            <option value="78">
              78
            </option>

            <option value="79">
              79
            </option>

            <option value="80">
              80
            </option>

            <option value="81">
              80+
            </option>
          </select></td>
        </tr>

        <tr>
          <td><label for="Education">Which best describes your level of education?</label> 
          </td>
        </tr>
        <tr>  
          <td><select id="Education" name="Education" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="1">
              Some high school
            </option>

            <option value="2">
              High school graduate or equivalent
            </option>

            <option value="3">
              Trade or vocational degree
            </option>

            <option value="4">
              Some college/university
            </option>

            <option value="5">
              Associate degree
            </option>

            <option value="6">
              Bachelors degree
            </option>

            <option value="7">
              Graduate or professional degree
            </option>
          </select></td>
        </tr>

        <tr>
          <td><label for="Employment">Which best describes your employment status?</label> 
          </td>
        </tr>
        <tr>  
          <td><select id="Employment" name="Employment" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="1">
              Employed full time
            </option>

            <option value="2">
              Trade or Vocational degree
            </option>

            <option value="3">
              Not employed but looking for work
            </option>

            <option value="4">
              Not employed and not looking for work
            </option>

            <option value="5">
              Retired
            </option>

            <option value="6">
              Student
            </option>

            <option value="7">
              Homemaker
            </option>
          </select></td>
        </tr>

        <tr>
          <td><label for="Marital">Which best describes your marital status?</label>
          </td>
        </tr>
        <tr>  
          <td><select id="Marital" name="Marital" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="1">
              Single - Not married
            </option>

            <option value="2">
              Married
            </option>

            <option value="3">
              Living with partner
            </option>

            <option value="4">
              Separated
            </option>

            <option value="5">
              Divorced
            </option>

            <option value="6">
              Widowed
            </option>
          </select></td>
        </tr>

        <tr>
          <td><label for="Income">Which includes your total yearly income (before taxes, in US$)?</label> 
          </td>
        </tr>
        <tr>  
          <td><select id="Income" name="Income" class="controlledWidth">
            <option value="">
              
            </option>
            
            <option value="1">
              Less than $20000
            </option>

            <option value="2">
              $20000 - $29999
            </option>

            <option value="3">
              $30000 - $39999
            </option>

            <option value="4">
              $40000 - $49999
            </option>

            <option value="5">
              $50000 - $69999
            </option>

            <option value="6">
              $70000 - $99999
            </option>

            <option value="7">
              $100000 or more
            </option>
          </select></td>
        </tr>
      </table><button type="submit" class="myButton">Continue</button>
    </form>
  </div>
</body>
</html>
