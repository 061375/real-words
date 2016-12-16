<?php
/**
 * Real Words Algorithm
 * @author Jeremy Heminger c/o Geographics
 * */

 /**
  * loops through words and makes a final judgement if the email is spam
  * @param string $i
  * */
function real_words($i) {
    
    // remove any HTML
    $i = strip_tags($i);
    
    if(false === pharma($i))return false;
    
    // maximum words we will allow before we say that this email is likely spam
    $threshhold = 3;
    
    $score = 0;
    
    // put all the words into an array to loop through
    $ws = explode(" ",$i);
    
    // loop all the words
    foreach($ws as $w) {
        if(false === real_word($w))$score++;    
    }
    
    // check the obverall score and return a verdict
    if($score > $threshhold)return false;
    return true;
}
 /**
  * loops through letters in the word to devine if the word is real
  * @param string $i
  * */
function real_word( $i ) {
    
    $vowels = 'aeiouy';
    
    $consonants = 'bcdfghjklmnpqrstvwxz';
    
    $score = 0;
    
    $overallscore = 0;
    
    $finalverdict = 0;
    
    // loop through all the letters in the word
    for($x=0; $x<strlen($i); $x++) {
        // get the letter at position x
        $l = substr($i,$x,1);
        
        // if we find a vowel...clear the scrore
        if(strpos($vowels,strtolower($l)) !== false)$score = 0;
        
        // if we find a consonant...how many have we found in a row?
        if(strpos($consonants,strtolower($l)) !== false)$score++;

        if($score == 3)$overallscore+=5;
        if($score == 4)$overallscore+=15;
        if($score == 5)$overallscore+=30;
        if($score >= 6)$overallscore+=60;
    }
    
    // based on the number of consectutive consonants in a row and the length of the word
    if(strlen($i) > 0)$finalverdict = $overallscore / strlen($i);

    // a final verdict is rendered if more than 15% of the word is garbage
    if($finalverdict > 15)return false;
    return true;
}
/**
 * string comparison looking for spam pharma emails
 * */
function pharma($i) {
    $count = 0;
    $max = 3;
    $pharma = array('cialis','viagra','levitra','propecia','amoxicilina','lithium','zoloft','paxil','valtrex','amoxicillin','fluoxetine');
    foreach($pharma as $p) {
        if(strpos(strtolower($i),$p) !== false) {
            $count++;
        }
        if($count > $max)continue;
    }
    if($count > $max)return false;
    return true;
}
?>