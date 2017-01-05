<?php
if (php_sapi_name() !== 'cli')die(); // no message if not cli

include "realwords.php";
$realwords = new JH_RealWords(true);

// TEST FOR SPAM
$t = 'I am interested in an internship in the following area 6: Other
Other: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
How did you hear about us?: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
Name: Yxweiefm
Organization: qljSkUsBBbUMiVfmX
Street address: NdosiflLh
City: KVfBLQwPvU
State: zFgpzOipjUD
Zip: HCqeQhlzZrGXSE
Daytime phone: OWqSkrhaleAbVkIzsW
Email: http://lev365.com Levitra Vs Viagra, ytdrih, 
Highest level of education completed and emphasis or major: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
Most recent work experience 1: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
Most recent work experience 2: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
reference 1: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
reference 2: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
Special skills or qualifications: comment2, http://lev365.com Levitra Vs Viagra, ytdrih, 
I certify that the above information is true and correct: True';
$r = $realwords->real_words($t);
if(false === $r){
    print "SPAM";
    print_r($realwords->get_found());
    $realwords->clear_found();
}else{print "NOT SPAM";}
print "\n";

// TEST FOR SPAM
$t = "How did you hear about us?: Cephalexin Dosage Chart For Cats  <a href=http://exdrugs.com>viagra online</a> Amoxicillin Pill Identifier Online Viagra Chewable Mediciations Without Perscription Buspar Discontinued  <a href=http://bmpha.com>levitra et jus de pamplemousse</a> Bentyl Real No Prescription Acquistare Levitra On Line Di Cialis Generic Yagara Kamagra Jelly 100mg Tolosa  <a href=http://achatpriligyfrance.com>priligy dosage</a> Nuevo Hora Para Tomar Propecia Cialis Generique Effet Secondaire Kamagra Soft Tabs 100mg  <a href=http://shopbyrxbox.com>viagra</a> Cialis Forum Cialis Pharmacy ajanta Kamagra Oral Jelly Acheter Kamagra Clermont Zithromax Other Names  <a href=http://corzide.com>viagra</a> Levitra 20mg 8 Stuck Preisvergleich Buy Generic Celebrex No Prescription Pastillas Priligy Precio Viagra With Dapoxetine Tetraciclina  <a href=http://gammam.net>where can i order levitra</a> Order Cost Of Propecia Cialis Verona Cialis Inconvenients Viagra 110 Mg  <a href=http://ilfrc.com>genericos del viagra</a> Commander Cialis Tadalafil Buy Valtrexin Usa Cialis Levitra Ou Viagra  <a href=http://euhomme.com>cialis price</a> Amoxil Effets Sildenafil And Dapoxetine In India Zithromax And Lyme Disease Comparaison Cialis Et Levitra Pharmacycustomercare  <a href=http://vkblue.com>buy strattera online usa pharmacy</a> Purchase Tadalafil Online Levitra En Horaire Propecia Dosis Calvicie  <a href=http://byrxboxshop.com>viagra</a> Cephalexin Can Cause Skin Rash Cialis Combien De Temps Avant
Questions or comments: Cephalexin Dosage Chart For Cats  <a href=http://exdrugs.com>viagra online</a> Amoxicillin Pill Identifier Online Viagra Chewable Mediciations Without Perscription Buspar Discontinued  <a href=http://bmpha.com>levitra et jus de pamplemousse</a> Bentyl Real No Prescription Acquistare Levitra On Line Di Cialis Generic Yagara Kamagra Jelly 100mg Tolosa  <a href=http://achatpriligyfrance.com>priligy dosage</a> Nuevo Hora Para Tomar Propecia Cialis Generique Effet Secondaire Kamagra Soft Tabs 100mg  <a href=http://shopbyrxbox.com>viagra</a> Cialis Forum Cialis Pharmacy ajanta Kamagra Oral Jelly Acheter Kamagra Clermont Zithromax Other Names  <a href=http://corzide.com>viagra</a> Levitra 20mg 8 Stuck Preisvergleich Buy Generic Celebrex No Prescription Pastillas Priligy Precio Viagra With Dapoxetine Tetraciclina  <a href=http://gammam.net>where can i order levitra</a> Order Cost Of Propecia Cialis Verona Cialis Inconvenients Viagra 110 Mg  <a href=http://ilfrc.com>genericos del viagra</a> Commander Cialis Tadalafil Buy Valtrexin Usa Cialis Levitra Ou Viagra  <a href=http://euhomme.com>cialis price</a> Amoxil Effets Sildenafil And Dapoxetine In India Zithromax And Lyme Disease Comparaison Cialis Et Levitra Pharmacycustomercare  <a href=http://vkblue.com>buy strattera online usa pharmacy</a> Purchase Tadalafil Online Levitra En Horaire Propecia Dosis Calvicie  <a href=http://byrxboxshop.com>viagra</a> Cephalexin Can Cause Skin Rash Cialis Combien De Temps Avant";
$r = $realwords->real_words($t);
if(false === $r){
    print "SPAM";
    print_r($realwords->get_found());
    $realwords->clear_found();
}else{print "NOT SPAM";}
print "\n";

// TEST FOR SPAM ( ONE WORD )
$t = "TYieSXBojtYt";
$r = $realwords->real_words($t);
if(false === $r){
    print "SPAM";
    print_r($realwords->get_found());
    $realwords->clear_found();}else{print "NOT SPAM";}
print "\n";

// TEST FOR SPAM ( non-ascii characters )
$t = "Доброе утро Добрый день Добрый вечер";
$r = $realwords->real_words($t);
if(false === $r){
    print "SPAM";
    print_r($realwords->get_found());
    $realwords->clear_found();}else{print "NOT SPAM";}
print "\n";

// TEST FOR NOT SPAM ( ONE WORD )
$t = "jeremy";

$r = $realwords->real_words($t);
if(false === $r){
    print "SPAM";
    print_r($realwords->get_found());
    $realwords->clear_found();}else{print "NOT SPAM";}
print "\n";

//TEST FOR NOT SPAM
$t = "This is a legitimate statement that has words that might through the test off like chrome, Archchronicler, catchphrase, eschscholtzia, latchstring, lengthsman, and postphthisic";

$r = $realwords->real_words($t);
if(false === $r){
    print "SPAM";
    print_r($realwords->get_found());
    $realwords->clear_found();}else{print "NOT SPAM";}
print "\n";
?>