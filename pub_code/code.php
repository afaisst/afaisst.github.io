<?php

## Function getpapers:
# This function searches NASA ADS for papers given a search dictionary in JSON format.
# It returns the results (as JSON text).
# The argument "$params" is a JSON text dictionary defining the search parameters, for example:
#
#    $params = '
#    {
#        "author":"Faisst,A",
#        "year1":2016,
#        "year2":2021,
#        "pos1":1,
#        "pos2":2,
#        "fields":"author,title,year,doctype,bibstem,issue,volume,page,bibcode,pubdate",
#        "rows":2000,
#        "token":"<token>"
#    }
#    ';
# 
# 'pos1' and 'pos2' are the minimum and maximum positions of the main author. In the above
# example, papers are searched for with "Faisst,A" as first or second author and papers in years
# 2016 to 2021.
# Note: <token> should be replaced with the token given by NASA ADS.
function getpapers($params){

    # convert parameters (in JSON text) to variable
    $params_json = json_decode($params);

    # Remove space from author
    $search_author = str_replace(" " , "+" , $params_json->author);

    # prepare
    $url = "https://api.adsabs.harvard.edu/v1/search/query?q=pos%28author:%22" . $search_author . "%22," . $params_json->pos1 . "," . $params_json->pos2 . "%29+year%3A%5B" . $params_json->year1 . "%20TO%20" . $params_json->year2 . "%5D&fl=" . $params_json->fields . "&rows=" . $params_json->rows . "&sort=date+desc";
    $header = "Authorization: Bearer " . $params_json->token . "";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header) );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $results = curl_exec($ch);

    return $results;

}


## Function createHTML
# This is a very specific function creating a HTML list from the
# output of function 'getpapers'. It can be modified to adjust to the layout
# of the webpage. It outputs the number of papers found (only articles and eprints) as
# well as an HTML string.
function createHTML($results){

    ## An array of months.
    $int_to_month = array("placeholder","January","February","March","April","May","June","July","August","September","October","November","December");

    ## The NASA ADS results are in JSON text form. Convert 
    # to variable that PHP can read
    $results_json = json_decode($results);

    ## Loop through each paper and assemble to HTML text
    $counter = 1; # this is the main counter (we are only taking "article" and "eprint" entries)
    $publication_html = ""; # where the HTML is stored
    foreach ($results_json->response->docs as $paper){
    
        if ($paper->doctype == "article" | $paper->doctype == "eprint" ){
    
            # Doc type (get all "article" and "eprint", discard rest)
            $doctype = $paper->doctype;
    
            # Title
            $title = $paper->title[0];
            
            # Year
            $year = $paper->year;
    
            # Create link to NASA ADS
            $nasa_ads_link = "https://ui.adsabs.harvard.edu/abs/" . $paper->bibcode . "/abstract";
    
            # Full date
            $pubdate = $paper->pubdate;
            $pubdayint = explode("-",$pubdate)[2];
            $pubmonthint = explode("-",$pubdate)[1];
    
            # Assemble journal
            $journal = $paper->bibstem;
            $volume = $paper->volume;
            $page = $paper->page;
            if ($doctype == "article") {
                $journalref = $journal[0] . ", " . $volume . ", " . $page[0] . ", " . $int_to_month[intval($pubmonthint)] . " " . $year;
            }
            if ($doctype == "eprint"){
                $journalref = $page[0] . ", " . $int_to_month[intval($pubmonthint)] . " " . $year;
            }
    
            ## Assemble author list
            # Rules:
            # 1) add "et al." if more than 3 authors
            # 2) separate last author with "&" if only 3 authors.
            # 2) highlight main author (myself) 
            $authors = "";
            $author_count = 1;
            $author_totnbr = count($paper->author);
            foreach ($paper->author as $author) {
    
                # choose separator
                if ($author_count == 1){
                    $separator = "";
                } else {
                    if ($author_count == 3 & $author_totnbr == 3){
                        $separator = " & ";
                    } else {
                        $separator = ", ";
                    }
                }
    
                # add authors if less than 4
                if ($author_count < 4){
                    $this_author_last = explode(", " , $author)[0];
                    $this_author_first_initial = str_split( explode(", " , $author)[1] )[0] . ".";
                    $this_author = $this_author_first_initial . " " . $this_author_last;
                    if ($this_author_last == "Faisst"){ # make bold if main author
                        $authors = $authors . $separator . "<b>" . $this_author . "</b>";
                    } else {
                        $authors = $authors . $separator . $this_author;
                    }
                }
    
                # if max number of authors are reached, add "et al."
                if ($author_count == 4){
                    $authors = $authors . " et al.";
                }
    
                # Advance counter
                $author_count = $author_count + 1;
            }
    
    
            ## Assemble everything
            $this_publication_text = "<p class='w3-justify'><b>" . $counter . ". <a href='" . $nasa_ads_link . "' target='_blank'>" . $title . "</a></b><BR>" . $authors . ", <i>" . $journalref . "</i> " . "</p>";
    
            ## Add
            $publication_html = $publication_html . " " . $this_publication_text;
    
            ## Advance main counter
            $counter = $counter + 1;
        }
    } # end each paper

    return array($counter-1 , $publication_html);
}

?>