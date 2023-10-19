
<div>
    <h2>FORMULARZ 3.1</h2>
    <h3><a href="index.php">powrót</a></h3>
    <?php
    $langs = ['C', 'C++', 'Java', 'C#', 'HTML', 'CSS', 'XML', 'PHP', 'JavaScript'];
        echo
        '<form method="post" action="formFiles.php"><h4>Zamawiam tutorial z języka:</h4><p>';
        echo '<table>
            <tr> <td>Nazwisko: </td>
                <td><input name="surname" size="30" id="nazwa"/><label for="nazwa"></label></td>
                <td id="nazwa_error" class="czerwone"></td>
            </tr>
            <tr> <td>Wiek:</td>
                <td><input name="age" size ="30" id="wiek"/><label for="wiek"></label></td>
                <td id="wiek_error" class="czerwone"></td>
            </tr>
            <tr> <td>Państwo:</td>
                <td><select name="country" id="kraj">
                    <option value="PL" selected="selected">Polska</option>
                    <option value="UK">Wielka Brytania</option>
                </select><label for="kraj"></label>
                </td>
            </tr>
            <tr> <td>Adres e-mail: </td>
                <td><input name="email" size ="30" id="email"/><label for="email"></label></td>
                <td id="email_error" class="czerwone"></td>
            </tr>
        </table>';
    /**
     *  Pętla do wyświetlenia checkboxów dla tablicy asocjacyjnej $langs
     */
        foreach ($langs as $value) {
        echo '<input name="langs[' . $value . ']" type="checkbox" id="' . $value. '" 
                value="' . $value  . '"/><label for="' . $value . '">' . $value . '</label>    ';
        }
        echo '<span id="produkt_error" class="czerwone"></span></p>
            <h4>Sposób zapłaty:</h4>
            <p><input name="payment" id="euro" type="radio" value="euro"/><label for="euro">eurocard</label>
                <input name="payment" id="visa" type="radio" value= "visa"/><label for="visa">visa</label>
                <input name="payment" id="przelew" type="radio" value="przelew"/><label for="przelew">przelew</label><br/>
                <span id="zaplata_error" class="czerwone"></span><br>
                <input type="reset" value="Wyczyść"/>
                <input type="submit" name="submit" value="Zapisz"/>
                <input type="submit" name="submit" value="Pokaz"/>
                <input type="submit" name="submit" value="PHP"/>
                <input type="submit" name="submit" value="C++"/>
                <input type="submit" name="submit" value="Java"/></p>
        </form>';
    function addToFile(){
        $dataFile = fopen("data.txt", "a")or die("Nie udalo sie otworzyc pliku");
        $data="";
        if(isset($_POST) && ($_POST!="")) {
            foreach ($_POST as $key => $value){
                if($key!="submit") {
                    if(is_array($value)) $data .= " " . implode(', ', $value);
                    else $data .= " " . $value;
                }
            }
        }
        fwrite($dataFile,$data . "\n");
        fclose($dataFile);
    }
    function show(){
        $dataFile = fopen("data.txt", "r")or die("Nie udalo sie otworzyc pliku");
        echo fread($dataFile,filesize("data.txt"));
    }
    function showFiltered($tutorial){

    }

    if (isset($_REQUEST['submit'])){
        $action = $_REQUEST['submit'];
        switch ($action){
            case "Zapisz": addToFile(); break;
            case "Pokaz": show(); break;
            case "PHP": showFiltered('PHP'); break;
            case "C++": showFiltered('C++'); break;
            case "Java": showFiltered('Java'); break;
            default: echo "<p>error ? ? ? ?! !</p>";
        }
    }

    ?>
</div>
