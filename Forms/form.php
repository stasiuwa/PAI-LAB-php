
<div>
    <h2>FORMULARZ 2.2</h2>
    <h3><a href="../index.php">powrót</a></h3>
    <?php
        $langs = ['C', 'C++', 'Java', 'C#', 'HTML', 'CSS', 'XML', 'PHP', 'JavaScript'];
        echo
        '<form method="post" action="../FormHandlers/handleForm2_2.php"><h4>Zamawiam tutorial z języka:</h4><p>';
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
                <input type="submit" value=" Wyślij "/>
                <input type="reset" value=" Anuluj "/></p>
        </form>';
    ?>
</div>