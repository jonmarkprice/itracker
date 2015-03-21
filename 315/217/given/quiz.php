 <!DOCTYPE html>
<html>
  <head>
    <title>GRE Vocab Quiz</title>
    <meta name="author" content="Jon Beck" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="quiz.css" />
  </head>

  <body>
    <h1>Zelda&rsquo;s GRE Vocabulary Quiz</h1>

    
    <h2>
      inchoate &mdash;
      <span class="partofspeech">adjective</span>
    </h2>

    <form action="quiz.php" method="post">
      <ul id="choices">

                    <li>
              <input type="radio" name="guess" value=" airtight; impervious to external influence" 
                     id="item0" />
              <label for="item0">
                 airtight; impervious to external influence              </label>
            </li>
                        <li>
              <input type="radio" name="guess" value="newly begun, incomplete; not organized" 
                     id="item1" />
              <label for="item1">
                newly begun, incomplete; not organized              </label>
            </li>
                        <li>
              <input type="radio" name="guess" value="marked by or showing reverence for deity and devotion to divine worship; marked by conspicuous religiosity" 
                     id="item2" />
              <label for="item2">
                marked by or showing reverence for deity and devotion to divine worship; marked by conspicuous religiosity              </label>
            </li>
                        <li>
              <input type="radio" name="guess" value="marked by hot temper and easily provoked anger" 
                     id="item3" />
              <label for="item3">
                marked by hot temper and easily provoked anger              </label>
            </li>
                        <li>
              <input type="radio" name="guess" value="highly pertinent or appropriate; apt" 
                     id="item4" />
              <label for="item4">
                highly pertinent or appropriate; apt              </label>
            </li>
            
      </ul>

      <div>
        <input type="hidden" name="word" value="inchoate" />
        <input type="hidden" name="total" value="0" />
        <input type="hidden" name="correct" value="0" />
        <button id="submit" type="submit">Submit </button>
      </div>

    </form>
  </body>
</html>

