<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/20
 * Time: 下午2:43
 */
include_once('Product.php');

class TextProduct implements Product
{
    private $mfgProduct;

    public function getPropertites()
    {
        $this->mfgProduct = <<<MALI
<!doctype html>
<html><head>
<style type="text/css">
header{
      color:#900;
      font-weight:bold;
      font-size:24px;
      font-family:Verdana,Geneva,sans-serif;
      }
     p{
     font-family:Verdana, Geneva, sans-serif;
     font-size: 12px;
     }
     </style>
     <meta charset="UTF-8"></title></head>
     <body>
     <header>Mali</header>
     <p>Gone with the Wind is a 1939 American epic-historical romance film adapted from Margaret Mitchell's 1936 novel Gone with the Wind. It was produced by David O.
     Selznick of Selznick International Pictures and directed by Victor Fleming. Set in the American South against the backdrop of the American Civil War and Reconstruction era,
     the film tells the story of Scarlett O'Hara, the strong-willed daughter of a Georgia plantation owner, from her romantic pursuit of Ashley Wilkes, who is married to his cousin,
     Melanie Hamilton, to her marriage to Rhett Butler. The leading roles are portrayed by Vivien Leigh (Scarlett), Clark Gable (Rhett), Leslie Howard (Ashley), and Olivia de Havilland (Melanie).
     The production of the film was difficult from the start. Filming was delayed for two years due to Selznick's determination to secure Gable for the role of Rhett Butler,
     and the "search for Scarlett" led to 1,400 women being interviewed for the part. The original screenplay was written by Sidney Howard, but underwent many revisions by several writers in
     an attempt to get it down to a suitable length. The original director, George Cukor, was fired shortly after filming had begun and was replaced by Fleming, who in turn was briefly replaced
     by Sam Wood while Fleming took some time off due to exhaustion.
     </p>
     </body></html>
MALI;
        return $this->mfgProduct;
    }
}