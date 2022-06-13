<html>
	<head>
		<title>A8</title>
		<style>
			
		</style>
		<script>
			
		</script>
	</head>
	<body>
	<?php
		/*
			              a
			      b               c
			  d       e       f       g
			h   i   j   k   l   m   n   o
		*/
				 
		$tree['a'] = ['b', 'c'];
		$tree['b'] = ['d', 'e'];
		$tree['c'] = ['f', 'g'];
		$tree['d'] = ['h', 'i'];
		$tree['e'] = ['j', 'k'];
		$tree['f'] = ['l', 'm'];
		$tree['g'] = ['n', 'o'];
		
		$count = count($tree) - 1;
		$values = array();
		
		#Generates random values for all nodes
		while($count >= 0)
		{
			$keys = array_keys($tree);
			$currentNode = $tree[$keys[$count]];
			$sum = 0;
			foreach ($currentNode as $leaf)
			{
				$innerKeys = array_keys($values);
				$exists = false;
				foreach ($innerKeys as $v)
				{
					
					if ($v == $leaf)
					{
						$exists = true;
					}
					
				}
				
				if ($exists)
				{
					$sum += $values[$leaf];
				}
				else
				{
					$num = rand(1, 10);
					$values[$leaf] = $num;
					$sum += $num;
				}
			}
			$values[$keys[$count]] = $sum;
			$count--;
		}

		treePrint($tree, $values, 'a');
		
		function treePrint($tree, $values, $node)
		{
			if (isset($values[$node]))
			{
				echo $node."(".$values[$node],")<br />";
			}
			else
			{
				echo $node."(root)<br />";
			}
			
			if (!isset($tree[$node]))
			{
				return;
			}
				
			foreach ($tree[$node] as $n)
			{
				treePrint($tree, $values, $n);
			}
		}
		
		
		#Selected node of subtree to sum
		$subTreeNode = 'b';
		
		echo "<br />Sub tree '".$subTreeNode."':<br />";
		$subTreeSum = treeValue($tree, $values, $subTreeNode);
		
		function treeValue($tree, $values, $node)
		{
			static $sum;
			$sum += $values[$node];
			
			if (isset($values[$node]))
			{
				echo $node."(".$values[$node],")<br />";
			}
			
			if (!isset($tree[$node]))
			{
				return;
			}
				
			foreach ($tree[$node] as $n)
			{
				treevalue($tree, $values, $n);
			}
			return $sum;
		}
		
		echo "Sub tree total value: ".$subTreeSum;
	?>
		
	</body>
</html>