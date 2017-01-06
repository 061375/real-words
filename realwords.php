<?php
/**
 * Real Words Algorithm
 * @version 2.0.3
 * @author Jeremy Heminger c/o Geographics
 * */
class JH_RealWords
{
    /* ++++
     *
     *
     * */ 
    private $found;
    
    // ---
    
    private $debug;
    
    // ---
    
    private $nohtml;
    
    // ---
    
    private $nohttp;
    /* ++++
     *
     *
     * */ 
    
    /**
     * @param array $params flags for various operations
     * - @debug boolean : gather and output debug data
     * - @nohtml boolean : if true no html will be tolerated
     * - @nohttp boolean : if true no hyperlinks or URLs will be tolerated
     * */
    function __construct($params = array())
    {
        $this->debug = isset($params['debug']) ? $params['debug'] : false;
        $this->nohtml = isset($params['nohtml']) ? $params['nohtml'] : false;
        $this->nohttp = isset($params['nohttp']) ? $params['nohttp'] : false;
    }
    /**
     * loops through words and makes a final judgement if the email is spam
     * @param string $i
     * @param int $threshhold the number of matches before the program decides to call smap
     * @param mixed $threshhold2 the threashold to pass to real_word
     *              false - defaults to 11
     *              true  - is set to $threshhold * 3
     *              int   - user defined
     * @return boolean
     * */
    function real_words($i,$threshhold = 3,$threshhold2 = false) {
        
        // run filters if set
        if(false === $this->filters($i))return false;

        if(false === $threshhold2) {
            $threshhold2 = 11;
        }elseif(true === $threshhold2){
            $threshhold2 = $threshhold * 3;
        }
        
        // remove any HTML
        $i = strip_tags($i);
        
        // remove line-breaks and tabs
        $i = str_replace("\n"," ",$i);
        $i = str_replace("\r"," ",$i);
        $i = str_replace("\t","",$i);
        
        if(false === $this->pharma($i))return false;
        

        $score = 0;
        
        // put all the words into an array to loop through
        $ws = explode(" ",$i);
        

        $wc = count($ws);
        
        // if we only have one word in the field, then we will need to be strict
        if(1 == $wc)$threshhold = 0;
        
        // loop all the words
        foreach($ws as $w) {
            if(false === $this->real_word($w,$threshhold2))$score++;    
        }
        
        $this->print_debug(__METHOD__,"score: ".$score);
        
        // check the obverall score and return a verdict
        if($score > $threshhold)return false;
        return true;
    }
    /**
     * loops through letters in the word to devine if the word is real
     * @param string $i
     * @return boolean
     * */
    function real_word($i,$threshhold = 11) {
    
        // run filters if set
        if(false === $this->filters($i))return false;
        
        $vowels = 'aeiouy';
        
        $consonants = 'bcdfghjklmnpqrstvwxz';
        
        $score = 0;
        
        $overallscore = 0;
        
        $finalverdict = 0;
        
        $cap = 0;
        
        // checks if the word is all uppercase
        $is_allcaps = ctype_upper($i);
        
        $len = strlen($i);
        // loop through all the letters in the word
        
        $fv = false; // first vowel exception
        
        if(true === $this->debug)print "\n WORD: ".$i."\n";
        
        
        for($x=0; $x<$len; $x++) {
            // get the letter at position x
            $l = substr($i,$x,1);
            
            // if we find a vowel...clear the scrore
            if(strpos($vowels,strtolower($l)) !== false) {
                $fv = true;
                $score = 0;
            }
            
            // if we find a consonant...how many have we found in a row?
            if(strpos($consonants,strtolower($l)) !== false)$score++;
    
            // there should only be one capital letter per word (unless the word is all caps)
            if(false == $is_allcaps) {
                if(ctype_upper($l))$cap++;
                if($cap > 1)$score++;
            }
            
            // check for non-ascii characters (this is mainly to check for foreign languages )
            if(false === preg_match('[\x80-\xFF]',$l))$score++;
            
            // check for non-alpha numeric characters 
            if(false === ctype_alnum($l))$score++;
            
            // tally scores
            if($score == 3)$overallscore+=5;
            if($score == 4)$overallscore+=15;
            if($score == 5)$overallscore+=30;
            if($score >= 6)$overallscore+=60;
            
            if(false === $fv AND $score > 4)$overallscore+=100;
            
            $this->print_debug(__METHOD__,"score: ".$score);
        }
        
        $this->print_debug(__METHOD__,"overall: ".$overallscore);
        
        // based on the number of consectutive consonants in a row and the length of the word
        if(strlen($i) > 0)$finalverdict = $overallscore / strlen($i);
        
        $this->print_debug(__METHOD__,"finalverdict: ".$finalverdict);
        
        // a final verdict is rendered if more than $threshhold% of the word is garbage
        if($finalverdict > $threshhold) {
            $this->set_found($i);
            return false;
        }
        return true;
    }
    /**
     * string comparison looking for spam pharma emails
     * @param string
     * @return boolean
     * */
    function pharma($i,$threshhold = 3) {
        $count = 0;
        $pharma = array('cialis','viagra','levitra','propecia','amoxicilina','lithium','zoloft','paxil','valtrex','amoxicillin','fluoxetine');
        $j = explode(' ',$i);
        $len = count($j);
        $p_len = count($pharma);
        for($p=0; $p<$p_len; $p++) {
            for($x=0; $x<$len; $x++) {
                if(strpos(strtolower($j[$x]),$pharma[$p]) !== false) {
                    $this->set_found($j[$x].' : '.$pharma[$p]);
                    $count++;
                }
            }
            if($count > $threshhold)continue;
        }
        if($count > $threshhold)return false;
        return true;
    }
    /**
     * if filter is set check against and return
     * @param string
     * @return boolean
     * */
    private function filters($i)
    {
        // filter based on HTML if true
        if(true === $this->nohtml) {
            if($i != strip_tags($i)) {
                $this->print_debug(__METHOD__,"found HTML");
                return false;
            }
        }
        
        // filter URLs if true
        if(true === $this->nohttp) {
            if(strpos(strtolower($i),'http://') !== false
               OR strpos(strtolower($i),'https://') !== false) {
                $this->print_debug(__METHOD__,"found URL(s)");
                return false;
            }
        }
        return true;
    }
    
    // getters and setters
    
    /**
     * set debug
     * @param boolean $b
     * @return void
     * */
    function set_debug($b)
    {
        $this->debug = $b;
    }
    /**
     * set nohtml
     * @param boolean $b
     * @return void
     * */
    function set_nohtml($b)
    {
        $this->nohtml = $b;
    }
    /**
     * set nohttp
     * @param boolean $b
     * @return void
     * */
    function set_nohttp($b)
    {
        $this->nohttp = $b;
    }
    
    // getters and setters [for debugging]
    
    /**
     * set found matches
     * @param string $f
     * @return void
     * */
    function set_found($f)
    {
        if(false === $this->debug)return;
        $this->found[] = $f;
    }
    /**
     * get found matches
     * @return array
     * */
    function get_found()
    {
        return $this->found;
    }
    /**
     * clear found matches
     * @return void
     * */
    function clear_found()
    {
        $this->found = array();
    }
    /**
     * return found matches
     * @return mixed (false if none found)
     * */
    function num_found()
    {
        $f = count($this->found);
        if(0 == $f)return false;
        return $f;
    }
    /**
     * dump results after calculation for debugging
     * @param string $m the method calling the function
     * @param string $s the result
     * @return void
     * */
    function print_debug($m,$s)
    {
        if(false === $this->debug)return;
        print "\n".$m." = ".$s."\n";
    }
}
?>