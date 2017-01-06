<?php
if (php_sapi_name() !== 'cli')die(); // no message if not cli

include "realwords.php";
$realwords = new JH_RealWords(array('debug'=>true));


// TEST FOR SPAM WORDS
$t = 'What do you want to do?
Report a concern

Your Name
QnfWQmPv

Email Address
HUEGALIAZWs

Phone
GgGXTqHhtbth

Mailing Address
WeWtsJGo

Comment
4ygMYE FyLitCl7Pf7ojQdDUOLQOuaxTXbj5iNG';
$r = $realwords->real_words($t);
printresult($t,$r);

// TEST FOR SPAM WORDS ** LOWER THRESHOLD **
$t = 'first_name: Barnypok
last_name: YVAemlaVhYOSU
address: tgbvwuRudc
city: New York
zip: 52027
email: jfvynms4281rt@hotmail.com';
$r = $realwords->real_words($t,2,5);
printresult($t,$r);

// TEST FOR PHARMA SPAM
$t = "How did you hear about us?: Cephalexin Dosage Chart For Cats  <a href=http://exdrugs.com>viagra online</a> Amoxicillin Pill Identifier Online Viagra Chewable Mediciations Without Perscription Buspar Discontinued  <a href=http://bmpha.com>levitra et jus de pamplemousse</a> Bentyl Real No Prescription Acquistare Levitra On Line Di Cialis Generic Yagara Kamagra Jelly 100mg Tolosa  <a href=http://achatpriligyfrance.com>priligy dosage</a> Nuevo Hora Para Tomar Propecia Cialis Generique Effet Secondaire Kamagra Soft Tabs 100mg  <a href=http://shopbyrxbox.com>viagra</a> Cialis Forum Cialis Pharmacy ajanta Kamagra Oral Jelly Acheter Kamagra Clermont Zithromax Other Names  <a href=http://corzide.com>viagra</a> Levitra 20mg 8 Stuck Preisvergleich Buy Generic Celebrex No Prescription Pastillas Priligy Precio Viagra With Dapoxetine Tetraciclina  <a href=http://gammam.net>where can i order levitra</a> Order Cost Of Propecia Cialis Verona Cialis Inconvenients Viagra 110 Mg  <a href=http://ilfrc.com>genericos del viagra</a> Commander Cialis Tadalafil Buy Valtrexin Usa Cialis Levitra Ou Viagra  <a href=http://euhomme.com>cialis price</a> Amoxil Effets Sildenafil And Dapoxetine In India Zithromax And Lyme Disease Comparaison Cialis Et Levitra Pharmacycustomercare  <a href=http://vkblue.com>buy strattera online usa pharmacy</a> Purchase Tadalafil Online Levitra En Horaire Propecia Dosis Calvicie  <a href=http://byrxboxshop.com>viagra</a> Cephalexin Can Cause Skin Rash Cialis Combien De Temps Avant
Questions or comments: Cephalexin Dosage Chart For Cats  <a href=http://exdrugs.com>viagra online</a> Amoxicillin Pill Identifier Online Viagra Chewable Mediciations Without Perscription Buspar Discontinued  <a href=http://bmpha.com>levitra et jus de pamplemousse</a> Bentyl Real No Prescription Acquistare Levitra On Line Di Cialis Generic Yagara Kamagra Jelly 100mg Tolosa  <a href=http://achatpriligyfrance.com>priligy dosage</a> Nuevo Hora Para Tomar Propecia Cialis Generique Effet Secondaire Kamagra Soft Tabs 100mg  <a href=http://shopbyrxbox.com>viagra</a> Cialis Forum Cialis Pharmacy ajanta Kamagra Oral Jelly Acheter Kamagra Clermont Zithromax Other Names  <a href=http://corzide.com>viagra</a> Levitra 20mg 8 Stuck Preisvergleich Buy Generic Celebrex No Prescription Pastillas Priligy Precio Viagra With Dapoxetine Tetraciclina  <a href=http://gammam.net>where can i order levitra</a> Order Cost Of Propecia Cialis Verona Cialis Inconvenients Viagra 110 Mg  <a href=http://ilfrc.com>genericos del viagra</a> Commander Cialis Tadalafil Buy Valtrexin Usa Cialis Levitra Ou Viagra  <a href=http://euhomme.com>cialis price</a> Amoxil Effets Sildenafil And Dapoxetine In India Zithromax And Lyme Disease Comparaison Cialis Et Levitra Pharmacycustomercare  <a href=http://vkblue.com>buy strattera online usa pharmacy</a> Purchase Tadalafil Online Levitra En Horaire Propecia Dosis Calvicie  <a href=http://byrxboxshop.com>viagra</a> Cephalexin Can Cause Skin Rash Cialis Combien De Temps Avant";
$r = $realwords->real_words($t);
printresult($t,$r);

// TEST FOR SPAM ** ONE WORD **
$t = "tgbvwuRudc";
$r = $realwords->real_words($t);
printresult($t,$r);

// TEST FOR SPAM ** URL(s) **
$t = "this is an email that contains hyperlink to http://www.blah.com and a hyperling to https://myfakedomain.faketld";
$realwords->set_nohttp(true);
$r = $realwords->real_words($t);
// reset after test
$realwords->set_nohttp(false);
printresult($t,$r);


// TEST FOR SPAM ** HTML **
$t = "this is an email that contains <html><body><h1>This shouldn't be here</h1></body></html>";
$realwords->set_nohtml(true);
$r = $realwords->real_words($t);
// reset after test
$realwords->set_nohtml(false);
printresult($t,$r);

// TEST FOR SPAM ** NON-ALPHANUMERIC **
$t = "Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§Ÿš§";
$r = $realwords->real_words($t);
printresult($t,$r);

// TEST FOR NOT SPAM ** ONE WORD **
$t = "jeremy";
$r = $realwords->real_words($t);
printresult($t,$r);

//TEST FOR ** NOT SPAM **
$t = "This is a legitimate statement that has words that might through the test off like chrome, Archchronicler, catchphrase, eschscholtzia, latchstring, lengthsman, and postphthisic";

$r = $realwords->real_words($t);
printresult($t,$r);

function printresult($t,$r)
{
    global $realwords;
    print "\n\n TESTING: ".$t."\n\n";
    if(false === $r){
        print "FOUND SPAM : \n";
        print_r($realwords->get_found());
        $realwords->clear_found();
    }else{print "NOT SPAM";}
    print "\n-----------------------------------------------------------------------------------\n";
}
?>