<html>

	<head>
	    <meta charset="utf-8">
		<title>Search for Tags</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">  
		<link rel="stylesheet" type="text/css" href="css/search.css">
	    <script src="js/html5shiv.min.js"></script>
	    <script src="js/respond.min.js"></script> 
	    <script src="js/bootstrap.min.js"></script>   
	    <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <script>
         $(function() {
            var availableTutorials = [
               
	            "math",
				"simple math",
				"big numbers",
				"factorial",
				"positional-systems",
				"bitmasks",
				"prefix sum",
				"collatz",
				"logic",
				"graph theory",
				"shortest path",
				"hamiltonian circuit",
				"euler circuit",
				"max flow",
				"min cut",
				"max cut",
				"matching",
				"domination",
				"graph coloring",
				"ramsey numbers",
				"scc",
				"longest-paths",
				"vertex-cover",
				"mst",
				"independent set",
				"number theory",
				"gcd",
				"totient",
				"prime numbers",
				"factorisation",
				"lcm",
				"geometry",	
				"convex hull",
				"plane-geometry",
				"closest pair",
				"combinatorics",
				"knapsack",
				"sorting",
				"lcs",
				"partition",
				"rmq",	
				"stirling",
				"subset sum",
				"set theory",
				"partial order",
				"linear order",
				"set cover",
				"topology",
				"metric space",
				"knot theory",
				"algebra",
				"group theory",
				"ring theory",
				"calculus",
				"differential equation",
				"probability theory",
				"real function",
				"zero of function",
				"linear algebra",
				"matrix",
				"linear system",
				"game theory",
				"game",
				"board game",
				"carrom",
				"chess",
				"text processing",
				"parsing",
				"validation",
				"string matching",
				"edit distance",
				"regular expressions",
				"algorithm",
				"dynamic programming",
				"linear programming",
				"recursion",
				"divide and conquer",
				"binary search",
				"bfs",
				"dfs",
				"flood fill",
				"quicksort",
				"branch and bound",
				"greedy",
				"Kruskal's algorithm",
				"Prim's algorithm",
				"brute force",
				"Dijkstra's algorithm",
				"kmp algorithm",
				"backtracking",
				"newton raphson",
				"heuristic",
				"sliding window",
				"lds",				
				"sieve of Eratosthenes",
				"extreme principle",
				"data structure",
				"array",
				"associative array",
				"2d array",
				"tree",
				"binary tree",
				"avl tree",
				"red black tree",
				"segment tree",
				"splay tree",
				"trie",
				"stack",
				"queue",
				"priority queue",
				"list",
				"singly linked list",
				"doubly linked list",
				"heap",
				"binomial heap",
				"fibonacci heap",
				"graph",		
				"hash table",
				"disjoint set"
            ];
            $("#tags").autocomplete({
               source: availableTutorials
            });
         });
      </script>


	</head>

	<body>
		<nav class = "navbar navbar-default navbar-fixed-top" id ="my-navbar">
			<div class = "container-fluid">
			    <div class = "navbar-header">
			      	<button type="button" class ="navbar-toggle" data-toggle = "collapse" data-target ="#navbar-collapse">
				    	<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				  	</button>
		         	<a href="#" class="navbar-brand">SpojTrackers</a>	
			    </div>
		       
		      	<div class="collapse navbar-collapse" id="navbar-collapse">
		         	<ul class="nav navbar-nav">
					</ul>
		      	</div>
		    </div>
	   	</nav>

	   	<div class="jumbotron" id="search">
	      
	      	<div class="container text-center">
	      		<h1>Let the Comparison Begin!</h1>
	      		<p></p>
	      		
	      		<div class="row">
				  	<form action="tags_final.php" method="post">
					  	<div class="col-lg-6">
						    <div class="input-group">
						      <span class="input-group-addon" id="sizing-addon1">Coder Handle</span>
						      <input type="text" class="form-control" placeholder="username..." name='handle'>
						    </div><!-- /input-group -->
					  	</div><!-- /.col-lg-6 -->
						
						<div class="col-lg-6">
							<div class="input-group">
							  
							    <div class="ui-widget input-group">
							    <span class="input-group-addon" id="sizing-addon1">Problem Tag</span>
							    <input type="text" class="form-control" placeholder="Search for..." name='tag' id="tags">
							    </div>
							    <span class="input-group-btn">
								    <button class="btn btn-default" type="submit">Go!</button>
							    </span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
					</form>
				</div><!-- /.row -->
			</div>
	    </div>
	    <?php
                include('simple_html_dom.php');
                include('proxy.php');

            //    error_reporting(0);

                if(!empty($_POST['handle']) && !empty($_POST['tag'])) {
    		    	
    	            	$handle=$_POST['handle'];
    	            	$tag=$_POST['tag'];
                        $cxt=stream_context_create($Context);
                        $url="http://www.spoj.com/problems/tags";    
	        			$user1=file_get_html($url,false,$cxt);
	        			
                        $list1=$user1->find('table[class=table table-condensed]',0);
                        $list2 = $list1->find('div a');
                        $size = sizeof($list2);
                        $flag=0;
                        for($i=0;$i<$size;$i++)
                        {
                            if($list1->find('div a',$i)->innertext==$tag)
                            {
                                //echo $list1->find('div a',$i)->innertext;
                                $link=$list1->find('div a',$i)->href;
                                $flag=1;
                                break;
                            }
                        }
                        if($flag!=1)
                        {
                            die("No such tag exist");
                        }
                        

                        $url_prob_tag="http://www.spoj.com".$link;
                        
                        $prob_tag=file_get_html($url_prob_tag,false,$cxt);
                        //print_r($prob_tag);
                        $prob_list=$prob_tag->find('td[align="left"]');
                        foreach($prob_list as $element)
                        {
                            $item[] = str_replace('/problems/','',$element->find('a',0)->href);
                        } 
                        // print_r($item); 
                     
                        sort($item);
                       
                        $url11="http://www.spoj.com/users/".$handle;
                        $user11=file_get_html($url11,false,$cxt);
                        $list_1=$user11->find('table[class=table table-condensed]',0);
                        $list_2=$list_1->find('a');
                        
                    for($i=0;$i<sizeof($list_2);$i++)
                    {

                       $list_3[$i] =  $list_1->find('a',$i)->innertext;
                    }
                    $list_3=array_filter($list_3);
                    sort($list_3);
                    //echo "<br>";
                    //print_r($list_3);
                    $result=array_intersect($list_3,$item);
                    sort($result);
                    
                     
                        //print_r($item);       
                    ?>

                    
                     <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#<?php echo $tag; ?> tag Problems done by <?php echo $handle; ?></h3>
                   <table class="table" width='70%'>
					<thead>
						<tr>
						<th><center>#</center></th>
           				<th><center>Problems</center></th>
           				</tr>

           				</thead>
           				<tbody>
           				<?php
           			
           			  $i=0;
           			foreach ($result as $element)
					{
								?>
								<tr>
						 		 	<center>
						 		 	<td><center><?php echo $i+1; ?></center></td>
						 		 	<td><center><font style="color : blue"> 
                              		<a href="<?php echo $lik.$x_ind;  ?>" target="_blank">
                                			<?php echo $element ?>
                                			</a></font></center></td>
						 		 	</center>
						 		 	</tr>
						 		 	<?php	
						 		 $i=$i+1;	
					}
				}

						?>
						</tbody>
						</table>

                    

	   <!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>   !-->
	    <script src="js/bootstrap.min.js"></script>   
	</body>
</html> 